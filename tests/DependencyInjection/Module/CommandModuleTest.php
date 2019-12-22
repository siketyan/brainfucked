<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\DependencyInjection\Module;

use PHPUnit\Framework\TestCase;
use Ray\Di\Injector;
use Siketyan\Brainfucked\Command\RunCommand;

class CommandModuleTest extends TestCase
{
    /**
     * Tests the module.
     */
    public function test(): void
    {
        $injector = new Injector(new CommandModule());

        $this->assertInstanceof(
            RunCommand::class,
            $injector->getInstance(RunCommand::class)
        );
    }
}
