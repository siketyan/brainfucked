<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Loop\LoopStack;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class Next implements InstructionInterface
{
    /**
     * @var MemoryInterface the memory to check
     */
    private $memory;

    /**
     * @var LoopStack the stack to pop current loop from
     */
    private $loopStack;

    /**
     * Next constructor.
     *
     * @param MemoryInterface $memory    the memory to check
     * @param LoopStack       $loopStack the stack to pop current loop from
     */
    public function __construct(MemoryInterface $memory, LoopStack $loopStack)
    {
        $this->memory = $memory;
        $this->loopStack = $loopStack;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return ']';
    }

    /**
     * {@inheritdoc}
     */
    public function do(RunnerInterface $runner): void
    {
        $loop = $this->loopStack->pop();

        if ($this->memory->get() !== 0) {
            $this->loopStack->push($loop);
            $loop->rollback();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(LanguageInterface $language): string
    {
        return $language->next();
    }
}
