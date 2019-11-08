<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Language;

interface LanguageInterface
{
    /**
     * Returns the token for backward instruction
     *
     * @return string e.g. '<'
     */
    public function backward(): string;

    /**
     * Returns the token for forward instruction
     *
     * @return string e.g. '>'
     */
    public function forward(): string;

    /**
     * Returns the token for increment instruction
     *
     * @return string e.g. '+'
     */
    public function increment(): string;

    /**
     * Returns the token for decrement instruction
     *
     * @return string e.g. '-'
     */
    public function decrement(): string;

    /**
     * Returns the token for read instruction
     *
     * @return string e.g. ','
     */
    public function read(): string;

    /**
     * Returns the token for write instruction
     *
     * @return string e.g. '.'
     */
    public function write(): string;

    /**
     * Returns the token for loop (while) instruction
     *
     * @return string e.g. '['
     */
    public function loop(): string;

    /**
     * Returns the token for next (end-while) instruction
     *
     * @return string e.g. ']'
     */
    public function next(): string;
}
