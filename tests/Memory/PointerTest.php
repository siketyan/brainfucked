<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Memory;

use PHPUnit\Framework\TestCase;

class PointerTest extends TestCase
{
    /**
     * @var Pointer the pointer to test
     */
    private $pointer;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->pointer = new Pointer();
    }

    /**
     * Tests the pointer.
     */
    public function test(): void
    {
        $this->assertSame(0, $this->pointer->getPosition());

        $this->pointer->next();
        $this->assertSame(1, $this->pointer->getPosition());

        $this->pointer->previous();
        $this->assertSame(0, $this->pointer->getPosition());
    }
}
