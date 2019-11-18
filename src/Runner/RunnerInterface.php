<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runner;

use Siketyan\Brainfucked\Instruction\InstructionInterface;

interface RunnerInterface
{
    /**
     * Runs the instructions.
     */
    public function run(): void;

    /**
     * Fast-forward to the instruction.
     *
     * @param InstructionInterface $instruction the target instruction
     */
    public function fastForward(InstructionInterface $instruction): void;

    /**
     * Gets the position where the interpreter is running at.
     *
     * @return int the current instruction position
     */
    public function getPosition(): int;

    /**
     * Sets the position where the interpreter is running at.
     *
     * @param int $position the instruction position to set
     */
    public function setPosition(int $position): void;
}
