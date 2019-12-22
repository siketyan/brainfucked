<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Reader\ReaderInterface;
use Siketyan\Brainfucked\Reader\Transaction;

class InstructionResolver
{
    /**
     * @var InstructionInterface[] the instructions to have
     */
    private $instructions;

    /**
     * InstructionResolver constructor.
     *
     * @param InstructionInterface ...$instructions the instructions to have
     */
    public function __construct(InstructionInterface ...$instructions)
    {
        $this->instructions = $instructions;
    }

    /**
     * Resolves the instruction by reading from the source.
     *
     * @param LanguageInterface $language    the language to resolve for
     * @param Transaction       $transaction the transaction to resolve on
     *
     * @return InstructionInterface|null the resolved instruction or null if not exists
     */
    public function resolve(LanguageInterface $language, Transaction $transaction): ?InstructionInterface
    {
        $reader = $transaction->getReader();

        foreach ($this->instructions as $instruction) {
            if ($this->tryToken($reader, $instruction->getToken($language))) {
                return $instruction;
            }

            /* @noinspection DisconnectedForeachInstructionInspection */
            $transaction->rollback();
        }

        return null;
    }

    /**
     * Tries to read the token.
     *
     * @param ReaderInterface $reader the reader to read from
     * @param string          $token  the token to try to read
     *
     * @return bool true if successfully read
     */
    private function tryToken(ReaderInterface $reader, string $token): bool
    {
        return $this->readString($reader, strlen($token)) === $token;
    }

    /**
     * Reads the string of the length.
     *
     * @param ReaderInterface $reader the reader to read from
     * @param int             $length the length to read
     *
     * @return string the read string
     */
    private function readString(ReaderInterface $reader, int $length): string
    {
        $buffer = '';

        for ($i = 0; $i < $length; $i++) {
            if (!$reader->isAvailable()) {
                break;
            }

            $buffer .= $reader->read();
        }

        return $buffer;
    }
}
