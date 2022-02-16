<?php

namespace Xamin123\LearnBlockchain\UI\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class AppCommand extends Command
{
    protected function configure(): void
    {
        parent::configure();
    }

    public function __construct(string $name = null)
    {
        parent::__construct($name);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Welcome!');

        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion('Select action', ['make payment', 'init user', 'show payments','exit']);
        do {
            $command = $helper->ask($input, $output, $question);
            $output->writeln('Ваше действие: ' . $command);
        } while ($command !== 'exit');

        return Command::SUCCESS;
    }
}