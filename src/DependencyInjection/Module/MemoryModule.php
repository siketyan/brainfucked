<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\DependencyInjection\Module;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Siketyan\Brainfucked\Memory\ArrayMemory;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Memory\Pointer;

class MemoryModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->bind(Pointer::class)
            ->in(Scope::SINGLETON);

        $this
            ->bind(MemoryInterface::class)
            ->to(ArrayMemory::class)
            ->in(Scope::SINGLETON);
    }
}
