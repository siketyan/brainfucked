<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runner;

interface RunnerInterface
{
    /**
     * Runs the instructions.
     */
    public function run(): void;

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
