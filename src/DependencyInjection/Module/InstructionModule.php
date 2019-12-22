<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\DependencyInjection\Module;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Siketyan\Brainfucked\Instruction\Backward;
use Siketyan\Brainfucked\Instruction\Decrement;
use Siketyan\Brainfucked\Instruction\Forward;
use Siketyan\Brainfucked\Instruction\Increment;
use Siketyan\Brainfucked\Instruction\Loop;
use Siketyan\Brainfucked\Instruction\Next;
use Siketyan\Brainfucked\Instruction\Read;
use Siketyan\Brainfucked\Instruction\Write;

class InstructionModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this->install(new LanguageModule());
        $this->install(new ConsoleModule());
        $this->install(new MemoryModule());
        $this->install(new LoopStackModule());

        $this->bind(Backward::class)->in(Scope::SINGLETON);
        $this->bind(Forward::class)->in(Scope::SINGLETON);
        $this->bind(Increment::class)->in(Scope::SINGLETON);
        $this->bind(Decrement::class)->in(Scope::SINGLETON);
        $this->bind(Read::class)->in(Scope::SINGLETON);
        $this->bind(Write::class)->in(Scope::SINGLETON);
        $this->bind(Next::class)->in(Scope::SINGLETON);
        $this->bind(Loop::class)->in(Scope::SINGLETON); // Depends to Next instruction class
    }
}
