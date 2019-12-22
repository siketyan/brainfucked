<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class Forward implements InstructionInterface
{
    /**
     * @var MemoryInterface the memory to operate
     */
    private $memory;

    /**
     * Forward constructor.
     *
     * @param MemoryInterface $memory the memory to operate
     */
    public function __construct(MemoryInterface $memory)
    {
        $this->memory = $memory;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return '>';
    }

    /**
     * {@inheritdoc}
     */
    public function do(RunnerInterface $runner): void
    {
        $this->memory->getPointer()->next();
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(LanguageInterface $language): string
    {
        return $language->forward();
    }
}
