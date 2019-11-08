<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Language;

class Brainfuck implements LanguageInterface
{
    /**
     * {@inheritdoc}
     */
    public function backward(): string
    {
        return '<';
    }

    /**
     * {@inheritdoc}
     */
    public function forward(): string
    {
        return '>';
    }

    /**
     * {@inheritdoc}
     */
    public function increment(): string
    {
        return '+';
    }

    /**
     * {@inheritdoc}
     */
    public function decrement(): string
    {
        return '-';
    }

    /**
     * {@inheritdoc}
     */
    public function read(): string
    {
        return ',';
    }

    /**
     * {@inheritdoc}
     */
    public function write(): string
    {
        return '.';
    }

    /**
     * {@inheritdoc}
     */
    public function loop(): string
    {
        return '[';
    }

    /**
     * {@inheritdoc}
     */
    public function next(): string
    {
        return ']';
    }
}
