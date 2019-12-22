<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Loop;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Runner\RunnerInterface;

class LoopTest extends TestCase
{
    /**
     * @var ObjectProphecy|RunnerInterface the prophecy of the interpreter to use
     */
    private $runnerP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->runnerP = $this->prophesize(RunnerInterface::class);
    }

    /**
     * Tests the loop.
     */
    public function test(): void
    {
        $position = 123;

        $this->runnerP
            ->getPosition()
            ->willReturn($position)
            ->shouldBeCalledOnce();

        $this->runnerP
            ->setPosition($position)
            ->shouldBeCalledOnce();

        $loop = new Loop($this->runnerP->reveal());
        $loop->rollback();
    }
}
