<?php

namespace App\Commands;

use App\Core\Connection;
use App\Exceptions\EmptyContentException;
use App\Repository\CreateTablesRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateTablesCommand extends Command
{
    const CONFIG_PATH = __DIR__ . '/../../configuration/mysql.yml';

    protected function configure()
    {
        $this
            ->setName('make:migration')
            ->setDescription('Creates a new tables in the database.')
            ->setHelp('This command allows you to create the necessary tables in the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Creating tables',
            '===============',
        ]);

        try {
            $connect = new Connection(self::CONFIG_PATH);
            $migration = new CreateTablesRepository($connect->getConnect());
            $migration->create();
            $output->writeln('done');
        } catch (EmptyContentException $e) {
            $output->writeln(sprintf('ERROR! %s', $e->getMessage()));
        }
    }
}