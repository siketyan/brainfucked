<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runtime;

use PHPUnit\Framework\TestCase;
use Siketyan\Brainfucked\Instruction\InstructionInterface;

class OperationTest extends TestCase
{
    /**
     * @var InstructionInterface the instruction of the operation
     */
    private $instruction;

    /**
     * @var Sourcemap the sourcemap of the operation
     */
    private $sourcemap;

    /**
     * @var Operation the operation to test
     */
    private $operation;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $instructionP = $this->prophesize(InstructionInterface::class);
        $sourcemapP = $this->prophesize(Sourcemap::class);

        $this->instruction = $instructionP->reveal();
        $this->sourcemap = $sourcemapP->reveal();
        $this->operation = new Operation(
            $this->instruction,
            $this->sourcemap
        );
    }

    /**
     * Tests the operation.
     */
    public function test(): void
    {
        $this->assertInstanceOf(Operation::class, $this->operation);
        $this->assertSame($this->instruction, $this->operation->getInstruction());
        $this->assertSame($this->sourcemap, $this->operation->getSourcemap());
    }
}
