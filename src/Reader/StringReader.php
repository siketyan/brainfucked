<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Reader;

use Siketyan\Brainfucked\Exception\EndOfStreamException;

class StringReader implements ReaderInterface
{
    /**
     * @var string
     */
    private $buffer;

    /**
     * @var int
     */
    private $length;

    /**
     * @var int
     */
    private $position;

    public function __construct(string $buffer)
    {
        $this->buffer = $buffer;
        $this->length = strlen($buffer);
        $this->position = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function read(): string
    {
        if (!$this->isAvailable()) {
            throw new EndOfStreamException(
                'Arrived to the end of the buffer.'
            );
        }

        return $this->buffer[$this->position++];
    }

    /**
     * {@inheritdoc}
     */
    public function seek(int $position): void
    {
        $this->position = $position;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function isAvailable(): bool
    {
        return $this->position < $this->length;
    }
}
