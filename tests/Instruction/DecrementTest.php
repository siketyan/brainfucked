<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class DecrementTest extends TestCase
{
    private const VALUE = 123;
    private const TOKEN = 'abc';
    private const NAME = '-';

    /**
     * @var ObjectProphecy|MemoryInterface the memory to use
     */
    private $memoryP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->memoryP = $this->prophesize(MemoryInterface::class);
    }

    /**
     * Tests to perform the instruction.
     */
    public function testDo(): void
    {
        $this->memoryP
            ->get()
            ->willReturn(self::VALUE)
            ->shouldBeCalledOnce();

        $this->memoryP
            ->set(self::VALUE - 1)
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
            ->decrement()
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
     * @return Decrement the created instance
     */
    private function getInstance(): Decrement
    {
        return new Decrement(
            $this->memoryP->reveal()
        );
    }
}
