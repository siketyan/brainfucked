<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Runner\RunnerInterface;

interface InstructionInterface
{
    /**
     * Converts the instruction to string that shows which instruction is running now.
     *
     * @return string the converted string
     */
    public function __toString(): string;

    /**
     * Does the instruction.
     *
     * @param RunnerInterface $runner the runner to do on
     */
    public function do(RunnerInterface $runner): void;

    /**
     * Gets the token for the instruction.
     *
     * @param LanguageInterface $language the language of the token
     *
     * @return string the token of the instruction
     */
    public function getToken(LanguageInterface $language): string;
}
