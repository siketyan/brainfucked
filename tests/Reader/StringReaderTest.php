<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Reader;

use PHPUnit\Framework\TestCase;
use Siketyan\Brainfucked\Exception\EndOfStreamException;

class StringReaderTest extends TestCase
{
    /**
     * @var StringReader the reader to test
     */
    private $reader;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->reader = new StringReader('abc');
    }

    /**
     * Tests the reader.
     */
    public function test(): void
    {
        $this->assertSame(0, $this->reader->getPosition());

        $this->assertSame('a', $this->reader->read());
        $this->assertSame(1, $this->reader->getPosition());

        $this->reader->seek(3);
        $this->assertSame(3, $this->reader->getPosition());

        $this->assertFalse($this->reader->isAvailable());
    }

    /**
     * Tests to read the end of the buffer.
     */
    public function testReadWithException(): void
    {
        $this->expectException(EndOfStreamException::class);

        $this->reader->seek(3);
        $this->reader->read();
    }

    /**
     * Tests to get the name.
     */
    public function testGetName(): void
    {
        $this->assertSame(
            '[String]',
            $this->reader->getName()
        );
    }
}
