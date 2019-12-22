<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runtime;

use PHPUnit\Framework\TestCase;

class SourcemapTest extends TestCase
{
    private const SOURCE = 'protocol://dummy.bf';
    private const POSITION = '1234';

    /**
     * @var Sourcemap the sourcemap to test
     */
    private $sourcemap;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->sourcemap = new Sourcemap(
            self::SOURCE,
            self::POSITION
        );
    }

    /**
     * Tests the sourcemap.
     */
    public function test(): void
    {
        $this->assertInstanceOf(Sourcemap::class, $this->sourcemap);
        $this->assertSame(self::SOURCE, $this->sourcemap->getSource());
        $this->assertSame(self::POSITION, $this->sourcemap->getPosition());
    }

    /**
     * Tests to convert to string.
     */
    public function testToString(): void
    {
        $this->assertSame(
            self::SOURCE . ':' . self::POSITION,
            (string) $this->sourcemap
        );
    }
}
