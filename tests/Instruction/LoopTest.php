<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Loop\Loop as CurrentLoop;
use Siketyan\Brainfucked\Loop\LoopStack;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class LoopTest extends TestCase
{
    private const POSITION = '123';
    private const TOKEN = 'abc';
    private const NAME = '[';

    /**
     * @var ObjectProphecy|MemoryInterface the memory to use
     */
    private $memoryP;

    /**
     * @var ObjectProphecy|Next the next instruction to use
     */
    private $nextP;

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
        $this->nextP = $this->prophesize(Next::class);
        $this->loopStackP = $this->prophesize(LoopStack::class);
    }

    /**
     * Tests to perform the instruction.
     */
    public function testDo(): void
    {
        $runnerP = $this->prophesize(RunnerInterface::class);

        $runnerP
            ->getPosition()
            ->willReturn(self::POSITION)
            ->shouldBeCalledOnce();

        $this->memoryP
            ->get()
            ->willReturn(1)
            ->shouldBeCalledOnce();

        /* @noinspection PhpParamsInspection */
        $this->loopStackP
            ->push(Argument::type(CurrentLoop::class))
            ->shouldBeCalledOnce();

        $this->getInstance()->do($runnerP->reveal());
    }

    /**
     * Tests to perform the instruction when the current memory is zero.
     */
    public function testDoWithZeroMemory(): void
    {
        $runnerP = $this->prophesize(RunnerInterface::class);

        $runnerP
            ->fastForward($this->nextP->reveal())
            ->shouldBeCalledOnce();

        $this->memoryP
            ->get()
            ->willReturn(0)
            ->shouldBeCalledOnce();

        $this->getInstance()->do($runnerP->reveal());
    }

    /**
     * Tests to get the token.
     */
    public function testGetToken(): void
    {
        $languageP = $this->prophesize(LanguageInterface::class);

        $languageP
            ->loop()
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
     * @return Loop the created instance
     */
    private function getInstance(): Loop
    {
        return new Loop(
            $this->memoryP->reveal(),
            $this->nextP->reveal(),
            $this->loopStackP->reveal()
        );
    }
}
