<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Memory;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Exception\OutOfRangeException;

class ArrayMemoryTest extends TestCase
{
    /**
     * @var ObjectProphecy|Pointer the prophecy of the pointer to use
     */
    private $pointerP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->pointerP = $this->prophesize(Pointer::class);
    }

    /**
     * Tests the memory.
     */
    public function test(): void
    {
        $position = 123;
        $value = 234;

        $this->pointerP
            ->getPosition()
            ->willReturn($position)
            ->shouldBeCalledTimes(2);

        $pointer = $this->pointerP->reveal();
        $memory = new ArrayMemory($pointer);
        $memory->set($value);

        $this->assertSame($value, $memory->get());
        $this->assertSame($pointer, $memory->getPointer());
    }

    /**
     * Tests the memory to set the value out of range.
     */
    public function testOutOfRange(): void
    {
        $this->expectException(OutOfRangeException::class);

        $memory = new ArrayMemory($this->pointerP->reveal());
        $memory->set(256);
    }
}
