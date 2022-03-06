<?php

namespace Xamin123\LearnBlockchain\UI\Console;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Xamin123\LearnBlockchain\Wallet\WalletInterface;

#[AsCommand(
    name: 'blockchain:run',
    description: 'Run blockchain app',
    hidden: false,
)]
class AppCommand extends Command
{
    public function __construct(private readonly WalletInterface $wallet)
    {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Welcome!');

        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion('Select action', ['make payment', 'init user', 'show payments', 'exit']);
        do {
            $command = $helper->ask($input, $output, $question);
            $output->writeln('Ваше действие: ' . $command);
        } while ($command !== 'exit');
        $output->writeln($this->wallet->hello());
        return Command::SUCCESS;
    }
}