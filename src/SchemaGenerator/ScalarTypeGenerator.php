<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\SchemaGenerator;

use JmvDevelop\GraphqlGenerator\Schema\ScalarType;
use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use League\Flysystem\FilesystemOperator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;
use function JmvDevelop\GraphqlGenerator\Utils\extractBaseNamespace;
use function JmvDevelop\GraphqlGenerator\Utils\extractShortName;
use function JmvDevelop\GraphqlGenerator\Utils\fqcn;
use function JmvDevelop\GraphqlGenerator\Utils\writeFile;

class ScalarTypeGenerator implements TypeGeneratorInterface
{
    public function __construct(protected ScalarType $type)
    {
    }

    public function createGetTypeMethodOnSchema(SchemaConfig $config, ClassType $class): Method
    {
        $dumper = new Dumper();

        $propertyName = 'property_scalar_type_'.$this->type->getName();
        $class->addProperty($propertyName)->setValue(null)->setPrivate();

        $method = $class->addMethod($this->getTypeMethodName($config));
        $method->setReturnType('\GraphQL\Type\Definition\CustomScalarType');
        $method->addBody(
            strtr(
                '
                if ($this->:property === null) {
                    $this->:property = new \GraphQL\Type\Definition\CustomScalarType([
                        "description" => :description,
                        "name" => :name,
                        "serialize" => function ($value) {
                            return $this->service(:serviceName)->serialize($value);
                        },
                        "parseValue" => function ($value) {
                            return $this->service(:serviceName)->parseValue($value);
                        },
                        "parseLiteral" => function (\GraphQL\Language\AST\Node $valueNode, array|null $variables = null) {
                            return $this->service(:serviceName)->parseLiteral($valueNode, $variables);
                        },
                    ]);
                }
                return $this->:property;
            ',
                [
                    ':property' => $propertyName,
                    ':serviceName' => $dumper->dump($this->concretFqcnClass($config)),
                    ':name' => $dumper->dump($this->type->getName()),
                    ':description' => $dumper->dump($this->type->getDescription()),
                ]
            )
        );

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
        return 'transform_scalar_type_'.$this->type->getName();
    }

    public function getTypeMethodName(SchemaConfig $config): string
    {
        return 'get_scalar_'.$this->type->getName();
    }

    /** @return array<string, string> */
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

        $serialize = $class->addMethod('serialize')->setAbstract();
        $serialize->addParameter('value')->setType($this->type->getRootType());
        $serialize->setReturnType('string|int|float|bool|null');

        $parseValue = $class->addMethod('parseValue')->setAbstract();
        $parseValue->addParameter('value')->setType('string|int|float|bool|null');
        $parseValue->setReturnType($this->type->getRootType());

        $parseLiteral = $class->addMethod('parseLiteral')->setAbstract();
        $parseLiteral->addParameter('valueNode')->setType('\GraphQL\Language\AST\Node');
        $parseLiteral->addParameter('variables')->setType('array')->setNullable(true);
        $parseLiteral->setReturnType($this->type->getRootType());

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
