<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Reader;

use PHPUnit\Framework\TestCase;

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
}
