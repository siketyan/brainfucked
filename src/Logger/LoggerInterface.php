<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Logger;

use Siketyan\Brainfucked\Instruction\InstructionInterface;

interface LoggerInterface
{
    /**
     * Logs the instruction.
     *
     * @param InstructionInterface $instruction the instruction to run
     */
    public function log(InstructionInterface $instruction): void;
}
