<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Loop;

use Siketyan\Brainfucked\Runner\RunnerInterface;

class Loop
{
    /**
     * @var RunnerInterface the runner that the loop is running on
     */
    private $runner;

    /**
     * @var int the operation position that the loop began
     */
    private $beginAt;

    /**
     * Loop constructor.
     *
     * @param RunnerInterface $runner the runner that the loop is running on
     */
    public function __construct(RunnerInterface $runner)
    {
        $this->runner = $runner;
        $this->beginAt = $runner->getPosition();
    }

    /**
     * Rolls back the interpreter to the beginning of the loop.
     */
    public function rollback(): void
    {
        $this->runner->setPosition($this->beginAt);
    }
}
