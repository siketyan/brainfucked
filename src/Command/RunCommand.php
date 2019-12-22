<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Command;

use Siketyan\Brainfucked\Exception\InvalidArgumentException;
use Siketyan\Brainfucked\Logger\SymfonyLogger;
use Siketyan\Brainfucked\Reader\FileReader;
use Siketyan\Brainfucked\Runner\Factory\InterpreterFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command
{
    private const NAME = 'run';

    /**
     * @var InterpreterFactory the factory of interpreter
     */
    private $interpreterFactory;

    public function __construct(InterpreterFactory $interpreterFactory)
    {
        $this->interpreterFactory = $interpreterFactory;

        parent::__construct(self::NAME);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'the file to run');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $file = $input->getArgument('file');

        if (!is_string($file)) {
            throw new InvalidArgumentException(
                'One of file needs to be specified.'
            );
        }

        $reader = new FileReader($file);
        $logger = new SymfonyLogger($output);

        $interpreter = $this->interpreterFactory->create($reader, $logger);
        $interpreter->run();

        return 0;
    }
}
