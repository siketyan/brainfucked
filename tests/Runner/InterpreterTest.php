<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runner;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Exception\FastForwardException;
use Siketyan\Brainfucked\Instruction\InstructionInterface;
use Siketyan\Brainfucked\Logger\LoggerInterface;

class InterpreterTest extends TestCase
{
    /**
     * @var ObjectProphecy|LoggerInterface
     */
    private $loggerP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->loggerP = $this->prophesize(LoggerInterface::class);
    }

    /**
     * Tests to run the interpreter.
     */
    public function testRun(): void
    {
        $instructions = [];

        for ($i = 0; $i < 2; $i++) {
            $instructionP = $this->prophesize(InstructionInterface::class);

            /* @noinspection PhpParamsInspection */
            $instructionP
                ->do(Argument::type(RunnerInterface::class))
                ->shouldBeCalledOnce();

            $instructions[] = $instructionP->reveal();
        }

        foreach ($instructions as $instruction) {
            $this->loggerP
                ->log($instruction)
                ->shouldBeCalledOnce();
        }

        $interpreter = new Interpreter(
            $instructions,
            $this->loggerP->reveal()
        );

        $interpreter->run();
    }

    /**
     * Tests to fast forward the interpreter.
     */
    public function testFastForward(): void
    {
        $instructions = [];

        for ($i = 0; $i < 4; $i++) {
            $instructions[] =
                $this
                    ->prophesize(InstructionInterface::class)
                    ->reveal();
        }

        $position = 2;
        $instruction = $instructions[$position];

        $interpreter = new Interpreter(
            $instructions,
            $this->loggerP->reveal()
        );

        $interpreter->fastForward($instruction);
        $this->assertSame($position, $interpreter->getPosition());
    }

    /**
     * Tests to fast forward the interpreter with unresolved instruction.
     */
    public function testFastForwardWithException(): void
    {
        $this->expectException(FastForwardException::class);

        $instructions = [];

        for ($i = 0; $i < 2; $i++) {
            $instructions[] =
                $this
                    ->prophesize(InstructionInterface::class)
                    ->reveal();
        }

        $interpreter = new Interpreter(
            $instructions,
            $this->loggerP->reveal()
        );

        $interpreter->fastForward(
            $this
                ->prophesize(InstructionInterface::class)
                ->reveal()
        );
    }

    /**
     * Tests to get and set the position of the interpreter.
     */
    public function testGetAndSetPosition(): void
    {
        $interpreter = new Interpreter(
            [],
            $this->loggerP->reveal()
        );

        $this->assertSame(0, $interpreter->getPosition());

        $interpreter->setPosition(123);
        $this->assertSame(123, $interpreter->getPosition());
    }
}
