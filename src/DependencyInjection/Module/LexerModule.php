<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\DependencyInjection\Module;

use Ray\Di\AbstractModule;
use Siketyan\Brainfucked\Lexer\Lexer;

class LexerModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this->install(new InstructionResolverModule());

        $this->bind(Lexer::class);
    }
}
