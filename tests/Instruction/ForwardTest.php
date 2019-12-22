<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Memory\Pointer;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class ForwardTest extends TestCase
{
    private const TOKEN = 'abc';
    private const NAME = '>';

    /**
     * @var ObjectProphecy|Pointer the pointer of the memory
     */
    private $pointerP;

    /**
     * @var ObjectProphecy|MemoryInterface the memory to use
     */
    private $memoryP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->pointerP = $this->prophesize(Pointer::class);
        $this->memoryP = $this->prophesize(MemoryInterface::class);
    }

    /**
     * Tests to perform the instruction.
     */
    public function testDo(): void
    {
        $this->pointerP
            ->next()
            ->shouldBeCalledOnce();

        $this->memoryP
            ->getPointer()
            ->willReturn($this->pointerP->reveal())
            ->shouldBeCalledOnce();

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
            ->forward()
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
     * @return Forward the created instance
     */
    private function getInstance(): Forward
    {
        return new Forward(
            $this->memoryP->reveal()
        );
    }
}
