<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Memory;

use Siketyan\Brainfucked\Exception\OutOfRangeException;

class ArrayMemory implements MemoryInterface
{
    private const SIZE = 65536;
    private const BYTE_MIN_VALUE = 0;
    private const BYTE_MAX_VALUE = 255;

    /**
     * @var int[] the memory array
     */
    private $bytes;

    /**
     * @var Pointer the pointer on the memory
     */
    private $pointer;

    public function __construct(Pointer $pointer)
    {
        $this->bytes = [];
        $this->pointer = $pointer;

        for ($i = 0; $i < self::SIZE; $i++) {
            $this->bytes[] = 0;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get(): int
    {
        return $this->bytes[$this->pointer->getPosition()];
    }

    /**
     * {@inheritdoc}
     */
    public function set(int $byte): void
    {
        if ($byte < self::BYTE_MIN_VALUE || $byte > self::BYTE_MAX_VALUE) {
            throw new OutOfRangeException(
                sprintf(
                    'The value must be between %d and %d.',
                    self::BYTE_MIN_VALUE,
                    self::BYTE_MAX_VALUE
                )
            );
        }

        $this->bytes[$this->pointer->getPosition()] = $byte;
    }

    /**
     * {@inheritdoc}
     */
    public function getPointer(): Pointer
    {
        return $this->pointer;
    }
}
