<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runner;

use Siketyan\Brainfucked\Exception\FastForwardException;
use Siketyan\Brainfucked\Instruction\InstructionInterface;
use Siketyan\Brainfucked\Logger\LoggerInterface;

class Interpreter implements RunnerInterface
{
    /**
     * @var InstructionInterface[] the instructions to run
     */
    private $instructions;

    /**
     * @var int the current instruction position where the interpreter is running
     */
    private $position;

    /**
     * @var LoggerInterface the logger to use
     */
    private $logger;

    /**
     * Interpreter constructor.
     *
     * @param InstructionInterface[] $instructions the instructions to run
     * @param LoggerInterface        $logger       the logger to use
     */
    public function __construct(array $instructions, LoggerInterface $logger)
    {
        $this->instructions = $instructions;
        $this->position = 0;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function run(): void
    {
        for ($count = count($this->instructions); $this->position < $count; $this->position++) {
            $instruction = $this->instructions[$this->position];

            $this->logger->log($instruction);

            $instruction->do($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function fastForward(InstructionInterface $instruction): void
    {
        for ($p = $this->position, $count = count($this->instructions); $p < $count; $p++) {
            if ($this->instructions[$p] === $instruction) {
                $this->setPosition($p);

                return;
            }
        }

        throw new FastForwardException(
            'Failed to fast-forward: No such instruction found.'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }
}
