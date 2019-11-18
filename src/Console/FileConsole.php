<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Console;

use Siketyan\Brainfucked\Exception\EndOfFileException;

class FileConsole implements ConsoleInterface
{
    /**
     * @var resource the file handle for input
     */
    private $inputHandle;

    /**
     * @var resource the file handle for output
     */
    private $outputHandle;

    /**
     * @var string[] the read buffer
     */
    private $buffer;

    public function __construct(string $inputUrl, string $outputUrl)
    {
        $this->inputHandle = fopen($inputUrl, 'rb');
        $this->outputHandle = fopen($outputUrl, 'wb');
    }

    /**
     * {@inheritdoc}
     */
    public function input(): int
    {
        while (empty($this->buffer)) {
            $line = fgets($this->inputHandle);

            if ($line === false) {
                break;
            }

            $this->buffer = array_reverse(
                str_split($line)
            );
        }

        if (empty($this->buffer) || ($character = array_pop($this->buffer)) === null) {
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
        fwrite($this->outputHandle, chr($byte));
    }
}
