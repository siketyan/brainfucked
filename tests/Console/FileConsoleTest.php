<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Console;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use PHPUnit\Framework\TestCase;
use Siketyan\Brainfucked\Exception\EndOfFileException;

class FileConsoleTest extends TestCase
{
    /**
     * @var vfsStreamFile the input file to use
     */
    private $inputFile;

    /**
     * @var vfsStreamFile the output file to use
     */
    private $outputFile;

    /**
     * @var vfsStreamDirectory the root directory of virtual filesystem
     */
    private $filesystem;

    /**
     * @var FileConsole the console to test
     */
    private $console;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->inputFile = new vfsStreamFile('input');
        $this->outputFile = new vfsStreamFile('output');

        $this->filesystem = vfsStream::setup();
        $this->filesystem->addChild($this->inputFile);
        $this->filesystem->addChild($this->outputFile);

        $this->console = new FileConsole(
            $this->inputFile->url(),
            $this->outputFile->url()
        );
    }

    /**
     * Tests to read a byte from the console.
     */
    public function testInput(): void
    {
        $this->inputFile->setContent('i');

        $this->assertSame(
            ord('i'),
            $this->console->input()
        );
    }

    /**
     * Tests to read a byte at the end of the file.
     */
    public function testInputWithEndOfFile(): void
    {
        $this->expectException(EndOfFileException::class);

        $this->inputFile->setContent('');
        $this->console->input();
    }

    /**
     * Tests to write the byte to the console.
     */
    public function testOutput(): void
    {
        $this->console->output(ord('o'));

        $this->assertSame(
            'o',
            $this->outputFile->getContent()
        );
    }
}
