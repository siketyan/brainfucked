<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runner\Factory;

use Siketyan\Brainfucked\Lexer\Lexer;
use Siketyan\Brainfucked\Logger\LoggerInterface;
use Siketyan\Brainfucked\Reader\ReaderInterface;
use Siketyan\Brainfucked\Runner\Interpreter;

class InterpreterFactory
{
    /**
     * @var Lexer the lexer to use
     */
    private $lexer;

    /**
     * InterpreterFactory constructor.
     *
     * @param Lexer $lexer the lexer to use
     */
    public function __construct(Lexer $lexer)
    {
        $this->lexer = $lexer;
    }

    /**
     * Creates an interpreter.
     *
     * @param ReaderInterface $reader the reader to use
     * @param LoggerInterface $logger the logger to use
     *
     * @return Interpreter the created interpreter
     */
    public function create(ReaderInterface $reader, LoggerInterface $logger): Interpreter
    {
        return new Interpreter(
            $this->lexer->lex($reader),
            $logger
        );
    }
}
