<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator;

use GraphQL\Language\Parser;
use JmvDevelop\GraphqlGenerator\Schema\Argument;
use JmvDevelop\GraphqlGenerator\Schema\MutationField;
use JmvDevelop\GraphqlGenerator\Schema\QueryField;
use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use League\Flysystem\FilesystemOperator;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\PhpFile;
use function JmvDevelop\GraphqlGenerator\Utils\addArgumentInParameterOfMethod;
use function JmvDevelop\GraphqlGenerator\Utils\callArgsFrom__args;
use function JmvDevelop\GraphqlGenerator\Utils\extractBaseNamespace;
use function JmvDevelop\GraphqlGenerator\Utils\extractShortName;
use function JmvDevelop\GraphqlGenerator\Utils\fqcn;
use function JmvDevelop\GraphqlGenerator\Utils\getPhpTypeOf;
use function JmvDevelop\GraphqlGenerator\Utils\getPsalmTypeOf;
use function JmvDevelop\GraphqlGenerator\Utils\getTypeFromRegistry;
use function JmvDevelop\GraphqlGenerator\Utils\writeFile;

final class SchemaGenerator
{
    private string $namespace;

    public function __construct(
        private SchemaConfig $config,
    ) {
        $this->namespace = $this->config->getNamespace();
    }

    public function generate(FilesystemOperator $fs): void
    {
        $fs->deleteDirectory('/Generated');

        foreach ($this->config->getSchema()->getTypes() as $type) {
            $type->getGenerator()->generateGeneratedClass(fs: $fs, config: $this->config);
            $type->getGenerator()->generateUserClass(fs: $fs, config: $this->config);
        }

        foreach ($this->config->getSchema()->getQueryFields() as $field) {
            $this->generateQueryOrMutationField($fs, $field);
        }

        foreach ($this->config->getSchema()->getMutationFields() as $field) {
            $this->generateQueryOrMutationField($fs, $field);
        }

        $this->generateSchema($fs);
    }

    private function generateSchema(FilesystemOperator $fs): void
    {
        $file = new PhpFile();
        $file->setStrictTypes(true);

        $namespace = $file->addNamespace($this->namespace.'\Generated');
        $class = $namespace
            ->addClass('AbstractSchema')
            ->addImplement('\Symfony\Contracts\Service\ServiceSubscriberInterface')
            ->setAbstract()
        ;

        $dumper = new Dumper();

        $construct = $class->addMethod('__construct');
        $construct->addPromotedParameter('services')->setType('\Psr\Container\ContainerInterface')->setPrivate();

        $serviceMethod = $class->addMethod('service')->setPrivate();
        $serviceMethod->addParameter('name')->setType('string');
        $serviceMethod->addBody('return $this->services->get($name);');

        /** @var array<string, string> $subscribedServices */
        $subscribedServices = [];

        foreach ($this->config->getSchema()->getTypes() as $type) {
            $type->getGenerator()->createGetTypeMethodOnSchema(config: $this->config, class: $class);
            $type->getGenerator()->createTransformTypeMethodOnSchema(config: $this->config, class: $class);
            $subscribedServices = array_merge([], $subscribedServices, $type->getGenerator()->subscribeService(config: $this->config));
        }

        $addQueryOrMutationType =
            /**
             * @param list<MutationField|QueryField> $fields
             * @param array<string, string>          $subscribedServices
             */
            function (string $methodName, string $fieldName, string $suffixClass, array $fields, array &$subscribedServices) use ($class, $dumper): void {
                $queryMethod = $class->addMethod($methodName);
                $queryMethod->setReturnType('\GraphQL\Type\Definition\ObjectType');

                $queryMethod->addBody('return new \GraphQL\Type\Definition\ObjectType([
                    "name" => ?,
                    "fields" => function() {
                        return [
                    ', [$fieldName]);

                foreach ($fields as $field) {
                    $class = $this->namespace.'\\'.$field->getSuffixNamespace().'\\'.ucfirst($field->getName()).$suffixClass;
                    $subscribedServices[$class] = $class;

                    $queryMethod->addBody(strtr(':fieldName => [
                        "name" => :fieldName,
                        "description" => :description,
                        "type" => :type,
                        "args" => :defArgs,
                        "resolve" => function($__root = null, null|array $__args = null) {
                            $__args = $__args === null ? [] : $__args;
                            return $this->service(:serviceName)->resolve(:callArgs);
                        },
                    ],', [
                        ':serviceName' => $dumper->dump($class),
                        ':fieldName' => $dumper->dump($field->getName()),
                        ':description' => $dumper->dump($field->getDescription()),
                        ':type' => getTypeFromRegistry(config: $this->config, type: Parser::parseType($field->getType())),
                        ':callArgs' => callArgsFrom__args(config: $this->config, args: $field->getArgs(), arrayName: '$__args'),
                        ':defArgs' => '['.implode(', ', array_map(function (Argument $argument) use ($dumper) {
                            return strtr('[
                                "name" => :name,
                                "description" => :description,
                                "type" => :type,
                            ]', [
                                ':name' => $dumper->dump($argument->getName()),
                                ':description' => $dumper->dump($argument->getDescription()),
                                ':type' => getTypeFromRegistry(config: $this->config, type: Parser::parseType($argument->getType())),
                            ]);
                        }, $field->getArgs())).']',
                    ]));
                }

                $queryMethod->addBody('
                        ];
                    },
                ]);');
            };

        $addQueryOrMutationType(
            methodName: 'query',
            fieldName: 'Query',
            suffixClass: 'Field',
            fields: $this->config->getSchema()->getQueryFields(),
            subscribedServices: $subscribedServices,
        );

        $addQueryOrMutationType(
            methodName: 'mutation',
            fieldName: 'Mutation',
            suffixClass: 'Mutation',
            fields: $this->config->getSchema()->getMutationFields(),
            subscribedServices: $subscribedServices
        );

        $getSubscribedServicesMethod = $class->addMethod('getSubscribedServices')->setReturnType('array')->setStatic();
        $getSubscribedServicesMethod->addBody('return ?;', [$subscribedServices]);

        $userFile = new PhpFile();
        $userFile->setStrictTypes(true);

        $userNamespace = $userFile->addNamespace($this->namespace);
        $userClass = $userNamespace->addClass('Schema');
        $userClass->setFinal()->addExtend('\\'.$this->namespace.'\\Generated\\AbstractSchema');

        $baseNs = $this->config->getNamespace();
        writeFile(fs: $fs, baseNs: $baseNs, file: $file, overwrite: true);
        writeFile(fs: $fs, baseNs: $baseNs, file: $userFile, overwrite: false);
    }

    private function generateQueryOrMutationField(FilesystemOperator $fs, QueryField|MutationField $field): void
    {
        $suffixClass = $field instanceof QueryField ? 'Field' : 'Mutation';

        $file = new PhpFile();
        $file->setStrictTypes(true);

        $abstractClass = fqcn(config: $this->config, parts: [
            'Generated', $field->getSuffixNamespace(), 'Abstract'.ucfirst($field->getName()).$suffixClass,
        ]);

        $namespace = $file->addNamespace(extractBaseNamespace($abstractClass));
        $class = $namespace->addClass(extractShortName($abstractClass))->setAbstract();
        $resolveMethod = $class->addMethod('resolve');

        if ('' !== $field->getDescription()) {
            $resolveMethod->addComment($field->getDescription());
            $resolveMethod->addComment('');
        }

        $psalmReturnType = getPsalmTypeOf(config: $this->config, type: Parser::parseType($field->getType()));
        $phpReturnType = getPhpTypeOf(config: $this->config, type: Parser::parseType($field->getType()));

        if ($psalmReturnType !== $phpReturnType) {
            $resolveMethod->addComment('@return '.$psalmReturnType);
        }

        $resolveMethod->setReturnType($phpReturnType);

        foreach ($field->getArgs() as $argument) {
            addArgumentInParameterOfMethod(config: $this->config, method: $resolveMethod, arg: $argument);
        }

        $resolveMethod->setAbstract(true);

        if ($field instanceof QueryField) {
            $autoResolveReturnArg = $field->getAutoResolveReturnArg();
            if (null !== $autoResolveReturnArg) {
                $resolveMethod->setAbstract(false);
                $resolveMethod->addBody(sprintf('
                return $%s;
            ', $autoResolveReturnArg));
            }
        }

        $concretClass = fqcn(config: $this->config, parts: [
            $field->getSuffixNamespace(),
            ucfirst($field->getName()).$suffixClass,
        ]);

        $userFile = new PhpFile();
        $userFile->setStrictTypes(true);

        $userNamespace = $userFile->addNamespace(extractBaseNamespace($concretClass));
        $userClass = $userNamespace->addClass(extractShortName($concretClass));
        $userClass->setFinal()->addExtend('\\'.$abstractClass);

        $baseNs = $this->config->getNamespace();
        writeFile(fs: $fs, baseNs: $baseNs, file: $file, overwrite: true);
        writeFile(fs: $fs, baseNs: $baseNs, file: $userFile, overwrite: false);
    }
}
