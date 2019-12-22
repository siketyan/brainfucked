<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\DependencyInjection\Module;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Siketyan\Brainfucked\Loop\LoopStack;

class LoopStackModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->bind(LoopStack::class)
            ->in(Scope::SINGLETON);
    }
}
