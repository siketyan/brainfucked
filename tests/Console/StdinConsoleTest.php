<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Console;

use PHPUnit\Framework\TestCase;

class StdinConsoleTest extends TestCase
{
    /**
     * Tests the console.
     */
    public function test(): void
    {
        $this->assertInstanceOf(
            StdioConsole::class,
            new StdioConsole()
        );
    }
}
