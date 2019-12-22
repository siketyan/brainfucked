<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runner\Factory;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Lexer\Lexer;
use Siketyan\Brainfucked\Logger\LoggerInterface;
use Siketyan\Brainfucked\Reader\ReaderInterface;

class InterpreterFactoryTest extends TestCase
{
    /**
     * @var ObjectProphecy|Lexer the lexer to use
     */
    private $lexerP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->lexerP = $this->prophesize(Lexer::class);
    }

    /**
     * Tests to create an interpreter.
     */
    public function testCreate(): void
    {
        $readerP = $this->prophesize(ReaderInterface::class);
        $loggerP = $this->prophesize(LoggerInterface::class);

        $this->lexerP
            ->lex($readerP->reveal())
            ->willReturn([])
            ->shouldBeCalledOnce();

        $this->getInstance()->create(
            $readerP->reveal(),
            $loggerP->reveal()
        );
    }

    /**
     * Creates an instance of the factory.
     *
     * @return InterpreterFactory the created instance
     */
    private function getInstance(): InterpreterFactory
    {
        return new InterpreterFactory(
            $this->lexerP->reveal()
        );
    }
}
