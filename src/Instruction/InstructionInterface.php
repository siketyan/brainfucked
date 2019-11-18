<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Reader\ReaderInterface;
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
     * Checks whether the instruction supports the token at current head of the reader or not.
     *
     * @param LanguageInterface $language the language to check
     * @param ReaderInterface   $reader   the reader to read from
     *
     * @return bool true if supports
     */
    public function supports(LanguageInterface $language, ReaderInterface $reader): bool;
}
