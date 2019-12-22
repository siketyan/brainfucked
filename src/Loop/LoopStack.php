<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Loop;

use Siketyan\Brainfucked\Exception\EmptyStackException;

class LoopStack
{
    /**
     * @var Loop[] the loop stack
     */
    private $loops;

    public function __construct()
    {
        $this->loops = [];
    }

    /**
     * Pushes the loop to the stack.
     *
     * @param Loop $loop the loop to push
     */
    public function push(Loop $loop): void
    {
        $this->loops[] = $loop;
    }

    /**
     * Pops the loop from the stack.
     *
     * @return Loop the popped loop
     */
    public function pop(): Loop
    {
        $loop = array_pop($this->loops);

        if ($loop === null) {
            throw new EmptyStackException(
                'No loop found in the stack.'
            );
        }

        return $loop;
    }
}
