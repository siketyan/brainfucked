<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class Backward implements InstructionInterface
{
    /**
     * @var MemoryInterface the memory to operate
     */
    private $memory;

    /**
     * Backward constructor.
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
        return '<';
    }

    /**
     * {@inheritdoc}
     */
    public function do(RunnerInterface $runner): void
    {
        $this->memory->getPointer()->previous();
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(LanguageInterface $language): string
    {
        return $language->backward();
    }
}
