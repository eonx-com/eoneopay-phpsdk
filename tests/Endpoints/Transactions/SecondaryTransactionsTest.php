<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Transactions;

use EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet;
use EoneoPay\PhpSdk\Endpoints\Transaction;
use EoneoPay\PhpSdk\Interfaces\Endpoints\TransactionInterface;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Transaction
 */
class SecondaryTransactionsTest extends TransactionTestCase
{
    /**
     * Test capture transaction successfully.
     *
     * @return void
     */
    public function testCaptureSuccessfully(): void
    {
        $data = $this->createResponse([
            'action' => TransactionInterface::ACTION_CAPTURE
        ]);

        $expected = new Transaction(\array_merge($data, [
            'paymentSource' => new CreditCard($data['paymentSource'])
        ]));

        $actual = $this->createApiManager($data)->update('api-key', $expected);

        $this->performTransactionAssertions($expected, $actual);
        self::assertInstanceOf(
            CreditCard::class,
            ($actual instanceof Transaction) === true ? $actual->getPaymentSource() : null
        );
        self::assertInstanceOf(
            Ewallet::class,
            ($actual instanceof Transaction) === true ? $actual->getPaymentDestination() : null
        );
    }

    /**
     * Test refund transaction successfully.
     *
     * @return void
     */
    public function testRefundSuccessfully(): void
    {
        $data = $this->createResponse([
            'action' => TransactionInterface::ACTION_REFUND
        ]);

        $expected = new Transaction(\array_merge($data, [
            'paymentSource' => new CreditCard($data['paymentSource'])
        ]));

        self::assertInstanceOf(Transaction::class, $this->createApiManager()->delete('api-key', $expected));
    }
}
