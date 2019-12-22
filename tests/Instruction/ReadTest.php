<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Console\ConsoleInterface;
use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class ReadTest extends TestCase
{
    private const VALUE = 123;
    private const TOKEN = 'abc';
    private const NAME = ',';

    /**
     * @var ObjectProphecy|MemoryInterface the memory to use
     */
    private $memoryP;

    /**
     * @var ObjectProphecy|ConsoleInterface the console to use
     */
    private $consoleP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->memoryP = $this->prophesize(MemoryInterface::class);
        $this->consoleP = $this->prophesize(ConsoleInterface::class);
    }

    /**
     * Tests to perform the instruction.
     */
    public function testDo(): void
    {
        $this->memoryP
            ->set(self::VALUE)
            ->shouldBeCalledOnce();

        $this->consoleP
            ->input()
            ->willReturn(self::VALUE)
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
            ->read()
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
     * @return Read the created instance
     */
    private function getInstance(): Read
    {
        return new Read(
            $this->memoryP->reveal(),
            $this->consoleP->reveal()
        );
    }
}
