<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\DependencyInjection\Module;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Siketyan\Brainfucked\Console\ConsoleInterface;
use Siketyan\Brainfucked\Console\StdioConsole;

class ConsoleModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->bind(ConsoleInterface::class)
            ->to(StdioConsole::class)
            ->in(Scope::SINGLETON);
    }
}
