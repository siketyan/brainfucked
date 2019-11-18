<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Console;

interface ConsoleInterface
{
    /**
     * Reads 1 byte from the console as a number.
     *
     * @return int the read byte
     */
    public function input(): int;

    /**
     * Writes the byte to the console as a character.
     *
     * @param int $byte the byte to write
     */
    public function output(int $byte): void;
}
