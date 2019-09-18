<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Transactions;

use EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet;
use EoneoPay\PhpSdk\Endpoints\Transaction;
use EoneoPay\PhpSdk\Exceptions\ClientException;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Transaction
 */
class RetrieveTransactionTest extends TransactionTestCase
{
    /**
     * Test retrieve transaction by order id and transaction id for the authenticated user.
     *
     * @return void
     */
    public function testRetrieveSuccessfully(): void
    {
        $data = $this->createResponse([
            'action' => Transaction::ACTION_TRANSFER,
            'id' => 'order1',
            'paymentDestination' => [
                'token' => \mb_strtoupper($this->generateId()),
                'type' => 'ewallet'
            ],
            'paymentSource' => [
                'token' => \mb_strtoupper($this->generateId()),
                'type' => 'ewallet'
            ],
            'transactionId' => 'transaction1'
        ]);

        $expected = new Transaction(\array_merge($data, [
            'paymentDestination' => new Ewallet($data['paymentDestination']),
            'paymentSource' => new Ewallet($data['paymentSource'])
        ]));

        $apiManager = $this->createApiManager($data);

        $actual = $apiManager->findOneBy(Transaction::class, (string)\getenv('PAYMENTS_API_KEY'), [
            'id' => 'order1',
            'transactionId' => 'transaction1'
        ]);

        $this->performTransactionAssertions($expected, $actual);
        self::assertInstanceOf(
            Ewallet::class,
            ($actual instanceof Transaction) === true ? $actual->getPaymentSource() : null
        );
        self::assertInstanceOf(
            Ewallet::class,
            ($actual instanceof Transaction) === true ? $actual->getPaymentDestination() : null
        );
    }

    /**
     * Test that retrieve transaction throws client exception when transaction not found.
     *
     * @return void
     */
    public function testRetrieveThrowsClientExceptionWhenTransactionNotFound(): void
    {
        $apiManager = $this->createApiManager([
            'code' => 4707,
            'message' => 'Requested order could not be found.',
            'sub_code' => 1,
            'time' => '2019-02-25T02:31:59Z'
        ], 404);

        $this->expectException(ClientException::class);
        $this->expectExceptionCode(4707);
        $this->expectExceptionMessage('Requested order could not be found.');

        $apiManager->findOneBy(Transaction::class, (string)\getenv('PAYMENTS_API_KEY'), [
            'id' => 'order1',
            'transactionId' => 'transaction2'
        ]);
    }
}
