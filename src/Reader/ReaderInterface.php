<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Reader;

interface ReaderInterface
{
    /**
     * Reads a character.
     *
     * @return string the read character
     */
    public function read(): string;

    /**
     * Seeks the reader to the position.
     *
     * @param int $position the position to seek to
     */
    public function seek(int $position): void;

    /**
     * Gets the position of the reader.
     *
     * @return int the current position
     */
    public function getPosition(): int;

    /**
     * Gets the name of the source file or stream.
     *
     * @return string the name of the source
     */
    public function getName(): string;

    /**
     * Checks whether the reader can read more or not.
     *
     * @return bool true if the reader is available to read
     */
    public function isAvailable(): bool;
}
