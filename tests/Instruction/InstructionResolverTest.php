<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Instruction;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Siketyan\Brainfucked\Language\LanguageInterface;
use Siketyan\Brainfucked\Reader\StringReader;
use Siketyan\Brainfucked\Reader\Transaction;

class InstructionResolverTest extends TestCase
{
    /**
     * @var InstructionResolver the resolver to test
     */
    private $resolver;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->resolver = new InstructionResolver(
            $this->getInstruction('abc'),
            $this->getInstruction('def')
        );
    }

    /**
     * Tests to resolve the instruction,
     */
    public function testResolve(): void
    {
        $reader = new StringReader('abcdef');
        $transaction = new Transaction($reader);

        $languageP = $this->prophesize(LanguageInterface::class);

        $this->assertSame(
            'abc',
            (string) $this->resolver->resolve(
                $languageP->reveal(),
                $transaction
            )
        );
    }

    /**
     * Tests to resolve the instruction,
     */
    public function testResolveNotExists(): void
    {
        $reader = new StringReader('___');
        $transaction = new Transaction($reader);

        $languageP = $this->prophesize(LanguageInterface::class);

        $this->assertNull(
            $this->resolver->resolve(
                $languageP->reveal(),
                $transaction
            )
        );
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

        /* @noinspection TypesCastingCanBeUsedInspection */
        $instructionP
            ->__toString()
            ->willReturn($name);

        /* @noinspection PhpParamsInspection */
        $instructionP
            ->getToken(Argument::type(LanguageInterface::class))
            ->willReturn($name);

        return $instructionP->reveal();
    }
}
