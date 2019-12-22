<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Loop;

use PHPUnit\Framework\TestCase;
use Siketyan\Brainfucked\Exception\EmptyStackException;

class LoopStackTest extends TestCase
{
    /**
     * @var LoopStack the loop stack to test
     */
    private $loopStack;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->loopStack = new LoopStack();
    }

    /**
     * Tests the loop stack.
     */
    public function test(): void
    {
        $loop1 = $this->prophesize(Loop::class)->reveal();
        $loop2 = $this->prophesize(Loop::class)->reveal();

        $this->loopStack->push($loop1);
        $this->loopStack->push($loop2);

        // LILO
        $this->assertSame($loop2, $this->loopStack->pop());
        $this->assertSame($loop1, $this->loopStack->pop());
    }

    /**
     * Tests the empty loop stack.
     */
    public function testEmpty(): void
    {
        $this->expectException(EmptyStackException::class);
        $this->loopStack->pop();
    }
}
