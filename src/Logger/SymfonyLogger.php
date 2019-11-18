<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Logger;

use Siketyan\Brainfucked\Instruction\InstructionInterface;
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
    public function log(InstructionInterface $instruction): void
    {
        $this->output->write(
            '<comment>' . ((string) $instruction) . '</comment>',
            false,
            OutputInterface::VERBOSITY_VERBOSE
        );
    }
}
