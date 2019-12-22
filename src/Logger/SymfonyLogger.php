<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Logger;

use Siketyan\Brainfucked\Runtime\Operation;
use Symfony\Component\Console\Output\OutputInterface;

class SymfonyLogger implements LoggerInterface
{
    /**
     * @var OutputInterface the console output
     */
    private $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * {@inheritdoc}
     */
    public function log(Operation $operation): void
    {
        $this->output->write(
            '<comment>' . ((string) $operation->getInstruction()) . '</comment>',
            false,
            OutputInterface::VERBOSITY_VERBOSE
        );

        $this->output->writeln(
            ' (' . ((string) $operation->getSourcemap()) . ')',
            OutputInterface::VERBOSITY_VERY_VERBOSE
        );
    }
}
