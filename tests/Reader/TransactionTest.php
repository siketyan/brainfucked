<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Reader;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class TransactionTest extends TestCase
{
    /**
     * @var ObjectProphecy|ReaderInterface the reader to test with
     */
    private $readerP;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->readerP = $this->prophesize(ReaderInterface::class);
    }

    /**
     * Tests the transaction.
     */
    public function test(): void
    {
        $this->readerP
            ->getPosition()
            ->willReturn(123)
            ->shouldBeCalledOnce();

        $this->readerP
            ->seek(123)
            ->shouldBeCalledOnce();

        $transaction = new Transaction(
            $this->readerP->reveal()
        );

        $transaction->rollback();
    }

    /**
     * Tests to get the reader.
     */
    public function testGetReader(): void
    {
        $this->readerP
            ->getPosition()
            ->willReturn(123)
            ->shouldBeCalledOnce();

        $reader = $this->readerP->reveal();
        $transaction = new Transaction($reader);

        $this->assertSame($reader, $transaction->getReader());
    }
}
