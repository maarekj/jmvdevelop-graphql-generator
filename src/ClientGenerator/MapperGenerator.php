<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator;

use GraphQL\Type\Definition\EnumType;
use GraphQL\Type\Definition\InputObjectField;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\Type;
use function JmvDevelop\GraphqlGenerator\Utils\writeFile;
use League\Flysystem\FilesystemOperator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\PhpFile;

final class MapperGenerator
{
    public function __construct(private Config $config)
    {
    }

    public function generateMapper(FilesystemOperator $fs): void
    {
        $file = new PhpFile();
        $file->setStrictTypes(true);

        $namespace = $file->addNamespace($this->config->getNamespace().'\ClientGenerated');
        $class = $namespace
            ->addClass('AbstractMapper')
            ->setAbstract()
        ;

        foreach ($this->config->getSchema()->getTypeMap() as $type) {
            $this->generateType(class: $class, type: $type);
        }

        $userFile = new PhpFile();
        $userFile->setStrictTypes(true);

        $baseNs = $this->config->getNamespace();

        $userNamespace = $userFile->addNamespace($baseNs);
        $userClass = $userNamespace->addClass('Mapper');
        $userClass->setFinal()->addExtend('\\'.$baseNs.'\\ClientGenerated\\AbstractMapper');

        writeFile(fs: $fs, baseNs: $baseNs, file: $file, overwrite: true);
        writeFile(fs: $fs, baseNs: $baseNs, file: $userFile, overwrite: false);
    }

    private function compileInputObjectField(string $variable, InputObjectField $field): string
    {
        $dumper = new Dumper();

        $res = $dumper->dump($field->name).' => ';

        $res .= $this->compileInputObjectFieldType(variable: '('.$variable.')->'.$field->name.'', type: $field->getType(), canBeNull: true);

        return $res;
    }

    private function generateType(ClassType $class, Type $type): void
    {
        if ($type instanceof ScalarType) {
            $this->generateScalarType(class: $class, type: $type);
        } elseif ($type instanceof EnumType) {
            $this->generateEnumType(class: $class, type: $type);
        } elseif ($type instanceof InputObjectType) {
            $this->generateInputObjectType(class: $class, type: $type);
        }
    }

    private function generateScalarType(ClassType $class, ScalarType $type): void
    {
        $name = $type->name;

        $scalarConfig = $this->config->getScalarConfigOrThrow($name);

        $phpToGraphqlMethod = $class->addMethod('php_to_graphql_'.$name);
        $graphqlToPhpMethod = $class->addMethod('graphql_to_php_'.$name);

        $phpType = $scalarConfig->getPhpType();
        $psalmType = $scalarConfig->getPsalmType();

        $param = $phpToGraphqlMethod->addParameter('data');
        $param->setType($phpType);

        $graphqlToPhpMethod->setReturnType($phpType);

        if ($phpType !== $psalmType) {
            $phpToGraphqlMethod->setComment('@param '.$psalmType.' $data');
            $graphqlToPhpMethod->setComment('@return '.$psalmType);
        }

        $graphqlToPhpMethod->addParameter('data');

        if ('ID' === $name || 'String' === $name || 'Int' === $name || 'Float' === $name || 'Boolean' === $name) {
            $phpToGraphqlMethod->addBody('return $data;');
            $graphqlToPhpMethod->addBody('return $data;');
        } else {
            $phpToGraphqlMethod->setAbstract();
            $graphqlToPhpMethod->setAbstract();
        }
    }

    private function generateEnumType(ClassType $class, EnumType $type): void
    {
        $name = $type->name;

        $class->addMethod('php_to_graphql_'.$name)->setAbstract()->addParameter('data');
        $class->addMethod('graphql_to_php_'.$name)->setAbstract()->addParameter('data');
    }

    private function generateInputObjectType(ClassType $class, InputObjectType $type): void
    {
        $name = $type->name;

        $method = $class->addMethod('php_to_graphql_'.$name)->setReturnType('array');
        $inputClass = '\\'.$this->config->getNamespace().'\\ClientGenerated\\InputObject\\'.\ucfirst($type->name);
        $method->addParameter('data')->setType($inputClass);

        $method->addBody('return [
                ');

        foreach ($type->getFields() as $field) {
            $method->addBody($this->compileInputObjectField(variable: '$data', field: $field));
            $method->addBody(',');
        }

        $method->addBody('];');
    }

    private function compileInputObjectFieldType(string $variable, Type $type, bool $canBeNull): string
    {
        $nullOr = $canBeNull ? "({$variable}) === null ? null : " : '';

        if ($type instanceof NonNull) {
            /** @var Type $ofType */
            $ofType = $type->getOfType();

            return $this->compileInputObjectFieldType(variable: $variable, type: $ofType, canBeNull: false);
        } elseif ($type instanceof ListOfType) {
            /** @var Type $ofType */
            $ofType = $type->getOfType();

            return \strtr(':nullOr array_map(fn ($_value) => (:sub), (:variable))', [
                ':nullOr' => $nullOr,
                ':variable' => $variable,
                ':sub' => $this->compileInputObjectFieldType(variable: '$_value', type: $ofType, canBeNull: true),
            ]);
        }

        return $nullOr.'$this->php_to_graphql_'.$type->name.'('.$variable.')';
    }
}
