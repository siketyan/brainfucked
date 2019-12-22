<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\DependencyInjection\Module;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Siketyan\Brainfucked\Language\Brainfuck;
use Siketyan\Brainfucked\Language\LanguageInterface;

class LanguageModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->bind(LanguageInterface::class)
            ->to(Brainfuck::class)
            ->in(Scope::SINGLETON);
    }
}
