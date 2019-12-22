<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\DependencyInjection\Module;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Siketyan\Brainfucked\DependencyInjection\Provider\InstructionResolverProvider;
use Siketyan\Brainfucked\Instruction\InstructionResolver;

class InstructionResolverModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this->install(new InstructionModule());

        $this
            ->bind(InstructionResolver::class)
            ->toProvider(InstructionResolverProvider::class)
            ->in(Scope::SINGLETON);
    }
}
