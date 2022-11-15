<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class BlogCommand extends Command
{
    protected static $defaultName = 'app:blog';
    protected static $defaultDescription = 'Add a short description for your command';

    protected function configure(): void
    {
        $this
            ->addArgument('titre', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('description', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('titre', null, InputOption::VALUE_REQUIRED, 'Option description')
            ->addOption('description', null,InputOption::VALUE_REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('titre');
        $arg2 = $input->getArgument('description');

        if ($arg1) {
            $io->warning(sprintf('You passed an argument: %s', $arg1));
            $io->note(sprintf('You passed an argument: %s', $arg2));
        }

        if ($input->getOption('titre')) {
            // ...
        }
        if ($input->getOption('description')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
