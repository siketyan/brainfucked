<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\DependencyInjection\Module;

use Ray\Di\AbstractModule;
use Siketyan\Brainfucked\Runner\Factory\InterpreterFactory;

class InterpreterModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this->install(new LexerModule());

        $this->bind(InterpreterFactory::class);
    }
}
