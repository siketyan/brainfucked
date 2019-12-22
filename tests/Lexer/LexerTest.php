<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Lexer;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Instruction\InstructionInterface;
use Siketyan\Brainfucked\Instruction\InstructionResolver;
use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Reader\StringReader;
use Siketyan\Brainfucked\Reader\Transaction;

class LexerTest extends TestCase
{
    /**
     * @var ObjectProphecy|LanguageInterface the language to use
     */
    private $languageP;

    /**
     * @var ObjectProphecy|InstructionResolver the resolver to use
     */
    private $resolverP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->languageP = $this->prophesize(LanguageInterface::class);
        $this->resolverP = $this->prophesize(InstructionResolver::class);
    }

    /**
     * Tests to lex.
     *
     * @noinspection StaticClosureCanBeUsedInspection
     */
    public function testLex(): void
    {
        $reader = new StringReader('foobar');
        $instruction = $this->getInstruction('bar');
        $count = 0;

        /* @noinspection PhpParamsInspection */
        $this->resolverP
            ->resolve(
                $this->languageP->reveal(),
                Argument::type(Transaction::class)
            )
            ->will(
                function () use (&$instruction, &$count) {
                    return $count++ === 0 ? $instruction : null;
                }
            );

        $operations = $this->getInstance()->lex($reader);

        $this->assertCount(1, $operations);
        $this->assertSame($instruction, $operations[0]->getInstruction());
    }

    /**
     * Creates a fake instruction.
     *
     * @param string $name the name of the instruction
     *
     * @return InstructionInterface the created instruction
     */
    private function getInstruction(string $name): InstructionInterface
    {
        $instructionP = $this->prophesize(InstructionInterface::class);

        /* @noinspection PhpParamsInspection */
        $instructionP
            ->getToken(Argument::type(LanguageInterface::class))
            ->willReturn($name);

        return $instructionP->reveal();
    }

    /**
     * Creates an instance of Lexer.
     *
     * @return Lexer the created instance
     */
    private function getInstance(): Lexer
    {
        return new Lexer(
            $this->languageP->reveal(),
            $this->resolverP->reveal()
        );
    }
}
