<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Language;

use PHPUnit\Framework\TestCase;

class BrainfuckTest extends TestCase
{
    /**
     * @var LanguageInterface the language to test
     */
    private $language;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->language = new Brainfuck();
    }

    public function test(): void
    {
        $this->assertSame('<', $this->language->backward());
        $this->assertSame('>', $this->language->forward());
        $this->assertSame('+', $this->language->increment());
        $this->assertSame('-', $this->language->decrement());
        $this->assertSame(',', $this->language->read());
        $this->assertSame('.', $this->language->write());
        $this->assertSame('[', $this->language->loop());
        $this->assertSame(']', $this->language->next());
    }
}
