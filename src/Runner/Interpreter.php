<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runner;

use Siketyan\Brainfucked\Exception\FastForwardException;
use Siketyan\Brainfucked\Instruction\InstructionInterface;
use Siketyan\Brainfucked\Logger\LoggerInterface;
use Siketyan\Brainfucked\Runtime\Operation;

class Interpreter implements RunnerInterface
{
    /**
     * @var Operation[] the instructions to run
     */
    private $operations;

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
     * @param Operation[]     $operations the operations to run
     * @param LoggerInterface $logger     the logger to use
     */
    public function __construct(array $operations, LoggerInterface $logger)
    {
        $this->operations = $operations;
        $this->position = 0;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function run(): void
    {
        for ($count = count($this->operations); $this->position < $count; $this->position++) {
            $operation = $this->operations[$this->position];

            $this->logger->log($operation);

            $operation->getInstruction()->do($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function fastForward(InstructionInterface $instruction): void
    {
        for ($p = $this->position, $count = count($this->operations); $p < $count; $p++) {
            if ($this->operations[$p]->getInstruction() instanceof $instruction) {
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
