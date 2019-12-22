<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\DependencyInjection\Module;

use Ray\Di\AbstractModule;
use Siketyan\Brainfucked\Command\RunCommand;

class CommandModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this->install(new InterpreterModule());

        $this->bind(RunCommand::class);
    }
}
