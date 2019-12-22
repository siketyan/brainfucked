<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Command;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Siketyan\Brainfucked\Exception\InvalidArgumentException;
use Siketyan\Brainfucked\Logger\SymfonyLogger;
use Siketyan\Brainfucked\Reader\FileReader;
use Siketyan\Brainfucked\Runner\Factory\InterpreterFactory;
use Siketyan\Brainfucked\Runner\Interpreter;
use Symfony\Component\Console\Tester\CommandTester;

class RunCommandTest extends TestCase
{
    /**
     * @var string the URL of the fake file to use
     */
    private $url;

    /**
     * @var ObjectProphecy|InterpreterFactory the factory of interpreter
     */
    private $interpreterFactoryP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $file = new vfsStreamFile('fake');
        $filesystem = vfsStream::setup();
        $filesystem->addChild($file);

        $this->url = $file->url();
        $this->interpreterFactoryP = $this->prophesize(InterpreterFactory::class);
    }

    /**
     * Tests the command.
     */
    public function test(): void
    {
        $url = $this->url;

        $interpreterP = $this->prophesize(Interpreter::class);
        $interpreterP
            ->run()
            ->shouldBeCalledOnce();

        /* @noinspection PhpParamsInspection */
        $this->interpreterFactoryP
            ->create(
                Argument::that(
                    static function (FileReader $reader) use ($url) {
                        return $reader->getName() === basename($url);
                    }
                ),
                Argument::type(SymfonyLogger::class)
            )
            ->willReturn($interpreterP->reveal())
            ->shouldBeCalledOnce();

        $this->getTester()->execute([
            'file' => $this->url,
        ]);
    }

    /**
     * Tests the command with invalid file input.
     */
    public function testWithInvalidFile(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->getTester()->execute([
            'file' => null,
        ]);
    }

    /**
     * Creates a tester for the command.
     *
     * @return CommandTester the created tester
     */
    private function getTester(): CommandTester
    {
        return new CommandTester(
            new RunCommand(
                $this->interpreterFactoryP->reveal()
            )
        );
    }
}
