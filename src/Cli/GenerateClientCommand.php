<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Cli;

use JmvDevelop\GraphqlGenerator\ClientGenerator\ClientGenerator;
use JmvDevelop\GraphqlGenerator\ClientGenerator\Config;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

final class GenerateClientCommand extends Command
{
    public function __construct(string $name = null, private string $defaultConfig = './graphql-client-config.php')
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->addOption(
            'config',
            'c',
            InputOption::VALUE_REQUIRED,
            'The config file',
            $this->defaultConfig,
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $style->title('Generate client');

        $configPath = $input->getOption('config');
        Assert::stringNotEmpty($configPath);

        if (false === is_file($configPath)) {
            $style->error(sprintf('The config file %s not found', $configPath));

            return 1;
        }

        $style->table(['option', 'value'], [
            ['config', $configPath],
        ]);

        $config = (function () use ($configPath): Config {
            /** @psalm-suppress UnresolvableInclude */
            $config = require $configPath;
            Assert::isInstanceOf($config, Config::class);

            return $config;
        })();

        $fs = new Filesystem(new LocalFilesystemAdapter($config->getOut()));
        $generator = new ClientGenerator(config: $config);
        $generator->generateClient($fs);

        $style->success('Success');

        return 0;
    }
}
