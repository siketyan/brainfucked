<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runtime;

use Siketyan\Brainfucked\Instruction\InstructionInterface;

class Operation
{
    /**
     * @var InstructionInterface the instruction to operate
     */
    private $instruction;

    /**
     * @var Sourcemap the operation mapping in the source
     */
    private $sourcemap;

    public function __construct(InstructionInterface $instruction, Sourcemap $sourcemap)
    {
        $this->instruction = $instruction;
        $this->sourcemap = $sourcemap;
    }

    /**
     * @return InstructionInterface the instruction to operate
     */
    public function getInstruction(): InstructionInterface
    {
        return $this->instruction;
    }

    /**
     * @return Sourcemap the operation mapping in the source
     */
    public function getSourcemap(): Sourcemap
    {
        return $this->sourcemap;
    }
}
