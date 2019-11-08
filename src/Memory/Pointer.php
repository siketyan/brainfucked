<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Memory;

class Pointer
{
    /**
     * @var int the position of the pointer
     */
    private $position;

    public function __construct()
    {
        $this->position = 0;
    }

    /**
     * Backwards the pointer.
     */
    public function previous(): void
    {
        $this->position--;
    }

    /**
     * Forwards the pointer.
     */
    public function next(): void
    {
        $this->position++;
    }

    /**
     * Gets the position of the pointer
     *
     * @return int the current position
     */
    public function getPosition(): int
    {
        return $this->position;
    }
}
