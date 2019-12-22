<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runner;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Exception\FastForwardException;
use Siketyan\Brainfucked\Instruction\InstructionInterface;
use Siketyan\Brainfucked\Logger\LoggerInterface;
use Siketyan\Brainfucked\Runtime\Operation;

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
        /* @var Operation[] $operations */
        $operations = [];

        for ($i = 0; $i < 2; $i++) {
            $instructionP = $this->prophesize(InstructionInterface::class);
            $operationP = $this->prophesize(Operation::class);

            /* @noinspection PhpParamsInspection */
            $instructionP
                ->do(Argument::type(RunnerInterface::class))
                ->shouldBeCalledOnce();

            $operationP
                ->getInstruction()
                ->willReturn($instructionP->reveal())
                ->shouldBeCalledOnce();

            $operations[] = $operationP->reveal();
        }

        foreach ($operations as $operation) {
            $this->loggerP
                ->log($operation)
                ->shouldBeCalledOnce();
        }

        $interpreter = new Interpreter(
            $operations,
            $this->loggerP->reveal()
        );

        $interpreter->run();
    }

    /**
     * Tests to fast forward the interpreter.
     */
    public function testFastForward(): void
    {
        /* @var Operation[] $operations */
        $operations = [];

        for ($i = 0; $i < 4; $i++) {
            $instructionP = $this->prophesize(InstructionInterface::class);
            $operationP = $this->prophesize(Operation::class);

            $operationP
                ->getInstruction()
                ->willReturn($instructionP->reveal());

            $operations[] = $operationP->reveal();
        }

        $position = 2;
        $operation = $operations[$position];

        $interpreter = new Interpreter(
            $operations,
            $this->loggerP->reveal()
        );

        $interpreter->fastForward($operation->getInstruction());
        $this->assertSame($position, $interpreter->getPosition());
    }

    /**
     * Tests to fast forward the interpreter with unresolved instruction.
     */
    public function testFastForwardWithException(): void
    {
        $this->expectException(FastForwardException::class);

        /* @var Operation[] $operations */
        $operations = [];

        for ($i = 0; $i < 2; $i++) {
            $instructionP = $this->prophesize(InstructionInterface::class);
            $operationP = $this->prophesize(Operation::class);

            $operationP
                ->getInstruction()
                ->willReturn($instructionP->reveal())
                ->shouldBeCalledOnce();

            $operations[] = $operationP->reveal();
        }

        $interpreter = new Interpreter(
            $operations,
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
