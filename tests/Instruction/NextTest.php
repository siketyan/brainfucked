<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Loop\Loop as CurrentLoop;
use Siketyan\Brainfucked\Loop\LoopStack;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class NextTest extends TestCase
{
    private const TOKEN = 'abc';
    private const NAME = ']';

    /**
     * @var ObjectProphecy|MemoryInterface the memory to use
     */
    private $memoryP;

    /**
     * @var ObjectProphecy|LoopStack the loop stack to use
     */
    private $loopStackP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->memoryP = $this->prophesize(MemoryInterface::class);
        $this->loopStackP = $this->prophesize(LoopStack::class);
    }

    /**
     * Tests to perform the instruction.
     */
    public function testDo(): void
    {
        $loopP = $this->prophesize(CurrentLoop::class);

        $loopP
            ->rollback()
            ->shouldBeCalledOnce();

        $this->memoryP
            ->get()
            ->willReturn(1)
            ->shouldBeCalledOnce();

        $this->loopStackP
            ->pop()
            ->willReturn($loopP->reveal())
            ->shouldBeCalledOnce();

        $this->loopStackP
            ->push($loopP)
            ->shouldBeCalledOnce();

        $this->getInstance()->do(
            $this->prophesize(RunnerInterface::class)->reveal()
        );
    }

    /**
     * Tests to perform the instruction when the current memory is not zero.
     */
    public function testDoWithNonZeroMemory(): void
    {
        $loopP = $this->prophesize(CurrentLoop::class);

        $loopP
            ->rollback()
            ->shouldNotBeCalled();

        $this->memoryP
            ->get()
            ->willReturn(0)
            ->shouldBeCalledOnce();

        $this->loopStackP
            ->pop()
            ->willReturn($loopP->reveal())
            ->shouldBeCalledOnce();

        $this->loopStackP
            ->push($loopP)
            ->shouldNotBeCalled();

        $this->getInstance()->do(
            $this->prophesize(RunnerInterface::class)->reveal()
        );
    }

    /**
     * Tests to get the token.
     */
    public function testGetToken(): void
    {
        $languageP = $this->prophesize(LanguageInterface::class);

        $languageP
            ->next()
            ->willReturn(self::TOKEN)
            ->shouldBeCalledOnce();

        $this->assertSame(
            self::TOKEN,
            $this->getInstance()->getToken($languageP->reveal())
        );
    }

    /**
     * Tests to convert to string.
     */
    public function testToString(): void
    {
        $this->assertSame(
            self::NAME,
            (string) $this->getInstance()
        );
    }

    /**
     * Gets the instance of the instruction,
     *
     * @return Next the created instance
     */
    private function getInstance(): Next
    {
        return new Next(
            $this->memoryP->reveal(),
            $this->loopStackP->reveal()
        );
    }
}
