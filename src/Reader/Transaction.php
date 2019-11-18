<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Reader;

class Transaction
{
    /**
     * @var ReaderInterface the reader to run the transaction on
     */
    private $reader;

    /**
     * @var int the position of the reader where the transaction began
     */
    private $position;

    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
        $this->reset();
    }

    /**
     * Memorize the current position of the reader.
     */
    public function reset(): void
    {
        $this->position = $this->reader->getPosition();
    }

    /**
     * Rolls the reader back to the memorized position.
     */
    public function rollback(): void
    {
        $this->reader->seek($this->position);
    }
}
