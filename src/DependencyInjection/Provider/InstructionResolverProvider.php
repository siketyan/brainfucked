<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\DependencyInjection\Provider;

use Ray\Di\ProviderInterface;
use Siketyan\Brainfucked\Instruction\Backward;
use Siketyan\Brainfucked\Instruction\Decrement;
use Siketyan\Brainfucked\Instruction\Forward;
use Siketyan\Brainfucked\Instruction\Increment;
use Siketyan\Brainfucked\Instruction\InstructionResolver;
use Siketyan\Brainfucked\Instruction\Loop;
use Siketyan\Brainfucked\Instruction\Next;
use Siketyan\Brainfucked\Instruction\Read;
use Siketyan\Brainfucked\Instruction\Write;

class InstructionResolverProvider implements ProviderInterface
{
    private $backward;
    private $forward;
    private $increment;
    private $decrement;
    private $read;
    private $write;
    private $loop;
    private $next;

    public function __construct(
        Backward $backward,
        Forward $forward,
        Increment $increment,
        Decrement $decrement,
        Read $read,
        Write $write,
        Loop $loop,
        Next $next
    ) {
        $this->backward = $backward;
        $this->forward = $forward;
        $this->increment = $increment;
        $this->decrement = $decrement;
        $this->read = $read;
        $this->write = $write;
        $this->loop = $loop;
        $this->next = $next;
    }

    /**
     * {@inheritdoc}
     */
    public function get(): InstructionResolver
    {
        return new InstructionResolver(
            $this->backward,
            $this->forward,
            $this->increment,
            $this->decrement,
            $this->read,
            $this->write,
            $this->loop,
            $this->next
        );
    }
}
