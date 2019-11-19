<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Console;

use Siketyan\Brainfucked\Exception\EndOfFileException;
use Siketyan\Brainfucked\Exception\IOException;

class FileConsole implements ConsoleInterface
{
    /**
     * @var resource|false the file handle for input
     */
    private $inputHandle;

    /**
     * @var resource|false the file handle for output
     */
    private $outputHandle;

    /**
     * @var string[] the read buffer
     */
    private $buffer;

    public function __construct(
        string $inputUrl,
        string $outputUrl,
        string $inputMode = 'rb',
        string $outputMode = 'wb'
    ) {
        $this->inputHandle = @fopen($inputUrl, $inputMode);
        $this->outputHandle = @fopen($outputUrl, $outputMode);
    }

    /**
     * {@inheritdoc}
     */
    public function input(): int
    {
        if ($this->inputHandle === false) {
            throw new IOException(
                'Failed to open input file stream.'
            );
        }

        while (empty($this->buffer)) {
            $line = fgets($this->inputHandle);

            if ($line === false) {
                break;
            }

            $this->buffer = array_reverse(
                str_split($line)
            );
        }

        if (empty($this->buffer) || ($character = $this->popCharacterFromBuffer()) === null) {
            throw new EndOfFileException(
                'Arrived to the end of the file.'
            );
        }

        return ord($character);
    }

    /**
     * {@inheritdoc}
     */
    public function output(int $byte): void
    {
        if ($this->outputHandle === false) {
            throw new IOException(
                'Failed to open input file stream.'
            );
        }

        fwrite($this->outputHandle, chr($byte));
    }

    /**
     * Pops a character from the read buffer.
     *
     * @return string|null
     */
    private function popCharacterFromBuffer(): ?string
    {
        return array_pop($this->buffer);
    }
}
