<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\SchemaGenerator;

use GraphQL\Language\Parser;
use JmvDevelop\GraphqlGenerator\Schema\Argument;
use JmvDevelop\GraphqlGenerator\Schema\ObjectType;
use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use function JmvDevelop\GraphqlGenerator\Utils\addArgumentInParameterOfMethod;
use function JmvDevelop\GraphqlGenerator\Utils\callArgsFrom__args;
use function JmvDevelop\GraphqlGenerator\Utils\extractBaseNamespace;
use function JmvDevelop\GraphqlGenerator\Utils\extractShortName;
use function JmvDevelop\GraphqlGenerator\Utils\fqcn;
use function JmvDevelop\GraphqlGenerator\Utils\getPhpTypeOf;
use function JmvDevelop\GraphqlGenerator\Utils\getPsalmTypeOf;
use function JmvDevelop\GraphqlGenerator\Utils\getTypeFromRegistry;
use function JmvDevelop\GraphqlGenerator\Utils\writeFile;
use League\Flysystem\FilesystemOperator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;

class ObjectTypeGenerator implements TypeGeneratorInterface
{
    public function __construct(private ObjectType $type)
    {
    }

    public function createGetTypeMethodOnSchema(SchemaConfig $config, ClassType $class): Method
    {
        $dumper = new Dumper();

        $serviceName = $this->concretFqcnClass($config);

        $propertyName = 'property_object_type_'.$this->type->getName();
        $class->addProperty($propertyName)->setValue(null)->setPrivate();

        $method = $class->addMethod($this->getTypeMethodName($config));
        $method->setReturnType('\GraphQL\Type\Definition\ObjectType');
        $method->addBody(\strtr('
            if ($this->:property === null) {
                $this->:property = new \GraphQL\Type\Definition\ObjectType([
                    "description" => :description,
                    "name" => :name,
                    "interfaces" => function () {
                        return [
                            :interfaces
                        ];
                    },
                    "fields" => function () {
                        return [
            ', [
            ':name' => $dumper->dump($this->type->getName()),
            ':description' => $dumper->dump($this->type->getDescription()),
            ':property' => $propertyName,
            ':interfaces' => \implode(",\n", \array_map(function (string $interface) use ($config): string {
                return getTypeFromRegistry($config, Parser::parseType($interface));
            }, $this->type->getInterfaces())),
        ]));

        foreach ($this->type->getFields() as $field) {
            $method->addBody(\strtr(':fieldName => [
                            "type" => :type,
                            "description" => :description,
                            "args" => :defArgs,
                            "resolve" => function($__root, array $__args = []) {
                                return $this->service(:serviceName)->:resolveMethod(root: $__root, :args);
                            },
                        ],', [
                ':fieldName' => $dumper->dump($field->getName()),
                ':resolveMethod' => 'resolve'.\ucfirst($field->getName()),
                ':serviceName' => $dumper->dump($serviceName),
                ':type' => getTypeFromRegistry($config, Parser::parseType($field->getType())),
                ':description' => $dumper->dump($field->getDescription()),
                ':args' => callArgsFrom__args(config: $config, args: $field->getArgs(), arrayName: '$__args'),
                ':defArgs' => '['.\implode(', ', \array_map(function (Argument $argument) use ($dumper, $config) {
                    return \strtr('[
                                "name" => :name,
                                "description" => :description,
                                "type" => :type,
                            ]', [
                        ':name' => $dumper->dump($argument->getName()),
                        ':description' => $dumper->dump($argument->getDescription()),
                        ':type' => getTypeFromRegistry(config: $config, type: Parser::parseType($argument->getType())),
                    ]);
                }, $field->getArgs())).']',
            ]));
        }

        $method->addBody(\strtr('
                        ];
                    },
                ]);
             }

             return $this->:property;', [
            ':property' => $propertyName,
        ]));

        return $method;
    }

    public function createTransformTypeMethodOnSchema(SchemaConfig $config, ClassType $class): Method
    {
        $method = $class->addMethod($this->transformTypeMethodName($config))->setPrivate();
        $method->addParameter('value');
        $method->addBody('return $value;');

        return $method;
    }

    public function transformTypeMethodName(SchemaConfig $config): string
    {
        return 'transform_object_type_'.$this->type->getName();
    }

    public function getTypeMethodName(SchemaConfig $config): string
    {
        return 'get_object_type_'.$this->type->getName();
    }

    public function subscribeService(SchemaConfig $config): array
    {
        return [
            $this->concretFqcnClass($config) => $this->concretFqcnClass($config),
        ];
    }

    public function generateGeneratedClass(FilesystemOperator $fs, SchemaConfig $config): void
    {
        $file = new PhpFile();
        $file->setStrictTypes(true);

        $namespace = $file->addNamespace(extractBaseNamespace($this->abstractFqcnClass($config)));
        $class = $namespace->addClass(extractShortName($this->abstractFqcnClass($config)))->setAbstract();

        $psalmType = $this->type->getPsalmType();
        $rootType = $this->type->getRootType();

        foreach ($this->type->getFields() as $field) {
            $resolveMethod = $class->addMethod('resolve'.\ucfirst($field->getName()));
            $psalmReturnType = getPsalmTypeOf(config: $config, type: Parser::parseType($field->getType()));
            $phpReturnType = getPhpTypeOf(config: $config, type: Parser::parseType($field->getType()));

            if ('' !== $field->getDescription()) {
                $resolveMethod->addComment($field->getDescription());
                $resolveMethod->addComment('');
            }

            if ($psalmReturnType !== $phpReturnType) {
                $resolveMethod->addComment('@return '.$psalmReturnType);
            }
            $resolveMethod->setReturnType($phpReturnType);

            if ($rootType !== $psalmType) {
                $resolveMethod->addComment('@psalm-param '.$psalmType.' $root');
            }
            $resolveMethod->addParameter('root')->setType($this->type->getRootType());

            foreach ($field->getArgs() as $arg) {
                addArgumentInParameterOfMethod(config: $config, method: $resolveMethod, arg: $arg);
            }

            $field->getGenerator()->generateBodyMethod(type: $this->type, field: $field, method: $resolveMethod);
        }

        writeFile(fs: $fs, baseNs: $config->getNamespace(), file: $file, overwrite: true);
    }

    public function generateUserClass(FilesystemOperator $fs, SchemaConfig $config): void
    {
        $file = new PhpFile();
        $file->setStrictTypes(true);

        $file
            ->addNamespace(extractBaseNamespace($this->concretFqcnClass($config)))
            ->addClass(extractShortName($this->concretFqcnClass($config)))->setFinal()
            ->addExtend('\\'.$this->abstractFqcnClass($config))
        ;

        writeFile(fs: $fs, baseNs: $config->getNamespace(), file: $file, overwrite: false);
    }

    public function concretFqcnClass(SchemaConfig $config): string
    {
        return fqcn(config: $config, parts: [
            $this->type->getSuffixNamespace(),
            \ucfirst($this->type->getName()).'Type',
        ]);
    }

    public function abstractFqcnClass(SchemaConfig $config): string
    {
        return fqcn(config: $config, parts: [
            'Generated',
            $this->type->getSuffixNamespace(),
            'Abstract'.\ucfirst($this->type->getName()).'Type',
        ]);
    }
}
