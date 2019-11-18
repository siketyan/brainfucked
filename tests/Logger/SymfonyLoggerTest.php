<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Logger;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Instruction\InstructionInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SymfonyLoggerTest extends TestCase
{
    /**
     * @var ObjectProphecy|InstructionInterface the instruction to test to log
     */
    private $instructionP;

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

        $this->outputP
            ->write(
                '<comment>abc</comment>',
                false,
                OutputInterface::VERBOSITY_VERBOSE
            )
            ->shouldBeCalledOnce();

        $logger = new SymfonyLogger($this->outputP->reveal());
        $logger->log($this->instructionP->reveal());
    }
}
