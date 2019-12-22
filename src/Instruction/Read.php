<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use Siketyan\Brainfucked\Console\ConsoleInterface;
use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class Read implements InstructionInterface
{
    /**
     * @var MemoryInterface the memory to put read bytes to
     */
    private $memory;

    /**
     * @var ConsoleInterface the console to read from
     */
    private $console;

    /**
     * Read constructor.
     *
     * @param MemoryInterface  $memory  the memory to put read bytes to
     * @param ConsoleInterface $console the console to read from
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
        return ',';
    }

    /**
     * {@inheritdoc}
     */
    public function do(RunnerInterface $runner): void
    {
        $this->memory->set(
            $this->console->input()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(LanguageInterface $language): string
    {
        return $language->read();
    }
}
