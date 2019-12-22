<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Console\ConsoleInterface;
use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Memory\MemoryInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class WriteTest extends TestCase
{
    private const VALUE = 123;
    private const TOKEN = 'abc';
    private const NAME = '.';

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
            ->get()
            ->willReturn(self::VALUE)
            ->shouldBeCalledOnce();

        $this->consoleP
            ->output(self::VALUE)
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
            ->write()
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
     * @return Write the created instance
     */
    private function getInstance(): Write
    {
        return new Write(
            $this->memoryP->reveal(),
            $this->consoleP->reveal()
        );
    }
}
