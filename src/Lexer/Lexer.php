<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Lexer;

use Siketyan\Brainfucked\Instruction\InstructionResolver;
use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Reader\ReaderInterface;
use Siketyan\Brainfucked\Reader\Transaction;
use Siketyan\Brainfucked\Runtime\Operation;
use Siketyan\Brainfucked\Runtime\Sourcemap;

class Lexer
{
    /**
     * @var LanguageInterface the language to lex in
     */
    private $language;

    /**
     * @var InstructionResolver the resolver for instructions
     */
    private $resolver;

    /**
     * Lexer constructor.
     *
     * @param LanguageInterface   $language the language to lex in
     * @param InstructionResolver $resolver the resolver for instructions
     */
    public function __construct(LanguageInterface $language, InstructionResolver $resolver)
    {
        $this->language = $language;
        $this->resolver = $resolver;
    }

    /**
     * Performs lexical analysis from the source code to instructions.
     *
     * @param ReaderInterface $reader the reader of the source code to parse
     *
     * @return Operation[] the analysed operations
     */
    public function lex(ReaderInterface $reader): array
    {
        $operations = [];

        while (true) {
            $position = $reader->getPosition();
            $transaction = new Transaction($reader);
            $instruction = $this->resolver->resolve($this->language, $transaction);

            if ($instruction !== null) {
                $operations[] = new Operation(
                    $instruction,
                    new Sourcemap(
                        $reader->getName(),
                        (string) $position
                    )
                );

                continue;
            }

            if (!$transaction->getReader()->isAvailable()) {
                break;
            }

            $reader->read();
        }

        return $operations;
    }
}
