<?php

namespace JmvDevelop\GraphqlGenerator\Cli;

use JmvDevelop\GraphqlGenerator\Generator;
use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

final class GenerateCommand extends Command
{
    protected function configure(): void
    {
        $this->addOption(
            'config',
            'c',
            InputOption::VALUE_REQUIRED,
            'The config file',
            './graphql-config.php',
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $style->title('Generate schema');

        $configPath = $input->getOption('config');
        Assert::stringNotEmpty($configPath);

        if (false === \is_file($configPath)) {
            $style->error(\sprintf('The config file %s not found', $configPath));

            return 1;
        }

        $style->table(['option', 'value'], [
            ['config', $configPath],
        ]);

        $config = (function () use ($configPath): SchemaConfig {
            /** @psalm-suppress UnresolvableInclude */
            $config = require $configPath;
            Assert::isInstanceOf($config, SchemaConfig::class);

            return $config;
        })();

        $fs = new Filesystem(new LocalFilesystemAdapter($config->getOut()));
        $generator = new Generator(config: $config);
        $generator->generate($fs);

        $style->success('Success');

        return 0;
    }
}
