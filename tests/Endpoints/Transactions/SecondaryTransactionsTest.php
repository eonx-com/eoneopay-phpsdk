<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Transactions;

use EoneoPay\PhpSdk\Endpoints\Amount;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet;
use EoneoPay\PhpSdk\Endpoints\Transaction;
use EoneoPay\PhpSdk\Interfaces\Endpoints\TransactionInterface;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Transaction
 */
final class SecondaryTransactionsTest extends TransactionTestCase
{
    /**
     * Test capture transaction successfully.
     *
     * @return void
     */
    public function testCaptureSuccessfully(): void
    {
        $data = $this->createResponse([
            'action' => TransactionInterface::ACTION_CAPTURE,
        ]);

        $expected = new Transaction(\array_merge($data, [
            'amount' => new Amount($data['amount']),
            'paymentSource' => new CreditCard($data['paymentSource']),
        ]));

        $actual = $this->createApiManager($data)->update('api-key', $expected);

        $actual = $this->performTransactionAssertions($expected, $actual);

        self::assertInstanceOf(Amount::class, $actual->getAmount());
        self::assertInstanceOf(CreditCard::class, $actual->getPaymentSource());
        self::assertInstanceOf(Ewallet::class, $actual->getPaymentDestination());
    }

    /**
     * Test refund transaction successfully.
     *
     * @return void
     */
    public function testRefundSuccessfully(): void
    {
        $data = $this->createResponse([
            'action' => TransactionInterface::ACTION_REFUND,
        ]);

        $expected = new Transaction(\array_merge($data, [
            'paymentSource' => new CreditCard($data['paymentSource']),
        ]));

        self::assertInstanceOf(Transaction::class, $this->createApiManager(null, 200)->delete('api-key', $expected));
    }
}
