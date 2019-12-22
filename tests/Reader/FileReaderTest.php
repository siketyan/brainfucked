<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Reader;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;

class FileReaderTest extends StringReaderTest
{
    private const NAME = 'fake.bf';

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $file = new vfsStreamFile(self::NAME);
        $file->setContent('abc');

        $filesystem = vfsStream::setup();
        $filesystem->addChild($file);

        $this->reader = new FileReader($file->url());
    }

    /**
     * {@inheritdoc}
     */
    public function testGetName(): void
    {
        $this->assertSame(
            self::NAME,
            $this->reader->getName()
        );
    }
}
