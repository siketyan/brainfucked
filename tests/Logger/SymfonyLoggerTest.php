<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Logger;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Instruction\InstructionInterface;
use Siketyan\Brainfucked\Runtime\Operation;
use Siketyan\Brainfucked\Runtime\Sourcemap;
use Symfony\Component\Console\Output\OutputInterface;

class SymfonyLoggerTest extends TestCase
{
    /**
     * @var ObjectProphecy|InstructionInterface the instruction of the operation
     */
    private $instructionP;

    /**
     * @var ObjectProphecy|Sourcemap the sourcemap of the operation
     */
    private $sourcemapP;

    /**
     * @var ObjectProphecy|Operation the operation to test to log
     */
    private $operationP;

    /**
     * @var ObjectProphecy|OutputInterface the console output to test to log to
     */
    private $outputP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->instructionP = $this->prophesize(InstructionInterface::class);
        $this->sourcemapP = $this->prophesize(Sourcemap::class);
        $this->operationP = $this->prophesize(Operation::class);
        $this->outputP = $this->prophesize(OutputInterface::class);
    }

    /**
     * Tests to log.
     */
    public function testLog(): void
    {
        /* @noinspection TypesCastingCanBeUsedInspection */
        $this->instructionP
            ->__toString()
            ->willReturn('abc');

        /* @noinspection TypesCastingCanBeUsedInspection */
        $this->sourcemapP
            ->__toString()
            ->willReturn('def');

        $this->operationP
            ->getInstruction()
            ->willReturn($this->instructionP->reveal());

        $this->operationP
            ->getSourcemap()
            ->willReturn($this->sourcemapP->reveal());

        $this->outputP
            ->write(
                '<comment>abc</comment>',
                false,
                OutputInterface::VERBOSITY_VERBOSE
            )
            ->shouldBeCalledOnce();

        $this->outputP
            ->writeln(
                ' (def)',
                OutputInterface::VERBOSITY_VERY_VERBOSE
            )
            ->shouldBeCalledOnce();

        $logger = new SymfonyLogger($this->outputP->reveal());
        $logger->log($this->operationP->reveal());
    }
}
