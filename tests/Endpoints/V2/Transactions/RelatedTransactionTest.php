<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\V2\Transactions;

use EoneoPay\PhpSdk\Endpoints\V2\Transaction;
use EoneoPay\PhpSdk\Endpoints\V2\Transactions\RelatedTransaction;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\Transactions\RelatedTransaction
 */
class RelatedTransactionTest extends TransactionTestCase
{
    /**
     * Test response and getters.
     *
     * @return void
     */
    public function testResponseAndGetters(): void
    {
        $response = [
            'children' => [['action' => 'debit']],
            'parents' => [['action' => 'authorise']]
        ];

        /**
         * @var \EoneoPay\PhpSdk\Endpoints\V2\Transactions\RelatedTransaction $actual
         */
        $actual = $this->createApiManager($response)
            ->findOneBy(RelatedTransaction::class, (string)\getenv('PAYMENTS_API_KEY'), [
                'orderId' => 'orderId',
                'transactionId' => 'transactionId'
            ]);

        $expectedChildren = [new Transaction(['action' => 'debit'])];
        $expectedParents = [new Transaction(['action' => 'authorise'])];

        self::assertEquals($expectedChildren, $actual->getChildren());
        self::assertEquals($expectedParents, $actual->getParents());
    }

    /**
     * Tests uri's.
     *
     * @return void
     */
    public function testUris(): void
    {
        $expected = [
            'get' => '/orders/orderId/transactions/transactionId/related'
        ];

        $related = new RelatedTransaction(['orderId' => 'orderId', 'transactionId' => 'transactionId']);

        self::assertSame($expected, $related->uris());
    }
}
