<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Loop\Loop as CurrentLoop;
use Siketyan\Brainfucked\Loop\LoopStack;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class Loop implements InstructionInterface
{
    /**
     * @var MemoryInterface the memory to check
     */
    private $memory;

    /**
     * @var Next the next instruction
     */
    private $next;

    /**
     * @var LoopStack the stack to push current loop to
     */
    private $loopStack;

    /**
     * Loop constructor.
     *
     * @param MemoryInterface $memory    the memory to check
     * @param Next            $next      the next instruction
     * @param LoopStack       $loopStack the stack to push current loop to
     */
    public function __construct(MemoryInterface $memory, Next $next, LoopStack $loopStack)
    {
        $this->memory = $memory;
        $this->next = $next;
        $this->loopStack = $loopStack;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return '[';
    }

    /**
     * {@inheritdoc}
     */
    public function do(RunnerInterface $runner): void
    {
        if ($this->memory->get() === 0) {
            $runner->fastForward($this->next);
        } else {
            $this->loopStack->push(
                new CurrentLoop($runner)
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(LanguageInterface $language): string
    {
        return $language->loop();
    }
}
