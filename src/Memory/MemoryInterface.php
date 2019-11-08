<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Memory;

interface MemoryInterface
{
    /**
     * Gets the value on the memory at the pointer.
     *
     * @return int the gotten value
     */
    public function get(): int;

    /**
     * Sets the value on the memory at the pointer.
     *
     * @param int $byte the value to set
     */
    public function set(int $byte): void;

    /**
     * Gets the pointer on the memory.
     *
     * @return Pointer the gotten pointer
     */
    public function getPointer(): Pointer;
}
