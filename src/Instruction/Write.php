<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use Siketyan\Brainfucked\Console\ConsoleInterface;
use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class Write implements InstructionInterface
{
    /**
     * @var MemoryInterface the memory to get bytes to write
     */
    private $memory;

    /**
     * @var ConsoleInterface the console to write to
     */
    private $console;

    /**
     * Write constructor.
     *
     * @param MemoryInterface  $memory  the memory to get bytes to write
     * @param ConsoleInterface $console the console to write to
     */
    public function __construct(MemoryInterface $memory, ConsoleInterface $console)
    {
        $this->memory = $memory;
        $this->console = $console;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return '.';
    }

    /**
     * {@inheritdoc}
     */
    public function do(RunnerInterface $runner): void
    {
        $this->console->output(
            $this->memory->get()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(LanguageInterface $language): string
    {
        return $language->write();
    }
}
