<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\SchemaGenerator;

use GraphQL\Language\Parser;
use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use JmvDevelop\GraphqlGenerator\Schema\UnionType;
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

class UnionTypeGenerator implements TypeGeneratorInterface
{
    public function __construct(private UnionType $type)
    {
    }

    public function createGetTypeMethodOnSchema(SchemaConfig $config, ClassType $class): Method
    {
        $dumper = new Dumper();

        $serviceName = $this->concretFqcnClass($config);

        $propertyName = 'property_union_type_'.$this->type->getName();
        $class->addProperty($propertyName)->setValue(null)->setPrivate();

        $method = $class->addMethod($this->getTypeMethodName($config));
        $method->setReturnType('\GraphQL\Type\Definition\UnionType');
        $method->addBody(strtr('
            if ($this->:property === null) {
                $this->:property = new \GraphQL\Type\Definition\UnionType([
                    "description" => :description,
                    "name" => :name,
                    "types" => [
                        :types
                    ],
                    "resolveType" => function($value) {
                        return $this->service(:serviceName)->resolveType($value);
                    },
                ]);
            }
            ', [
            ':serviceName' => $dumper->dump($serviceName),
            ':name' => $dumper->dump($this->type->getName()),
            ':description' => $dumper->dump($this->type->getDescription()),
            ':property' => $propertyName,
            ':types' => implode(",\n", array_map(function (string $type) use ($config) {
                return getTypeFromRegistry($config, Parser::parseType($type));
            }, $this->type->getTypes())),
        ]));

        $method->addBody(strtr('
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
        return 'transform_union_type_'.$this->type->getName();
    }

    public function getTypeMethodName(SchemaConfig $config): string
    {
        return 'get_union_type_'.$this->type->getName();
    }

    public function subscribeService(SchemaConfig $config): array
    {
        return [$this->concretFqcnClass($config) => $this->concretFqcnClass($config)];
    }

    public function generateGeneratedClass(FilesystemOperator $fs, SchemaConfig $config): void
    {
        $file = new PhpFile();
        $file->setStrictTypes(true);

        $namespace = $file->addNamespace(extractBaseNamespace($this->abstractFqcnClass($config)));
        $class = $namespace->addClass(extractShortName($this->abstractFqcnClass($config)))->setAbstract();

        $resolveMethod = $class->addMethod('resolveType');
        $psalmType = getPsalmTypeOf(config: $config, type: Parser::parseType($this->type->getName()), canBeNull: false);
        $phpType = getPhpTypeOf(config: $config, type: Parser::parseType($this->type->getName()), canBeNull: false);

        if ('' !== $this->type->getDescription()) {
            $resolveMethod->addComment($this->type->getDescription());
            $resolveMethod->addComment('');
        }

        $resolveMethod->setReturnType('\\GraphQL\\Type\\Definition\\Type');
        $resolveMethod->addParameter('value')->setType($phpType);

        if ($psalmType !== $phpType) {
            $resolveMethod->addComment('@var '.$psalmType.' $value');
        }

        $resolveMethod->setAbstract();

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
            ucfirst($this->type->getName()).'Type',
        ]);
    }

    public function abstractFqcnClass(SchemaConfig $config): string
    {
        return fqcn(config: $config, parts: [
            'Generated',
            $this->type->getSuffixNamespace(),
            'Abstract'.ucfirst($this->type->getName()).'Type',
        ]);
    }
}
