<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\TestCases;

use EoneoPay\PhpSdk\Endpoints\Transaction;
use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Interfaces\Endpoints\TransactionInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;

/**
 * @coversNothing
 */
abstract class TransactionTestCase extends ValidationEnabledTestCase
{
    /**
     * Create transaction response.
     *
     * @param mixed[]|null $data
     *
     * @return mixed[]
     */
    protected function createResponse(?array $data = null): array
    {
        return \array_merge([
            'action' => TransactionInterface::ACTION_DEBIT,
            'amount' => [
                'currency' => 'AUD',
                'payment_fee' => '0.00',
                'subtotal' => '100.00',
                'total' => '100.00',
            ],
            'id' => \uniqid('ord', false),
            'paymentSource' => [
                'token' => 'VRG2VR4F39343HM4D3N2',
                'type' => 'credit_card',
            ],
            'transactionId' => \uniqid('txn', false),
            'paymentDestination' => [
                'id' => \uniqid('', false),
                'pan' => '2...H6A3',
                'type' => 'ewallet',
            ],
            'user' => new User([
                'email' => 'user@email.test',
            ]),
        ], $data ?? []);
    }

    /**
     * Perform transaction assertions.
     *
     * @param \EoneoPay\PhpSdk\Endpoints\Transaction $expected
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $actual
     *
     * @return \EoneoPay\PhpSdk\Endpoints\Transaction
     */
    protected function performTransactionAssertions(Transaction $expected, EntityInterface $actual): Transaction
    {
        self::assertInstanceOf(Transaction::class, $actual);

        /**
         * @var \EoneoPay\PhpSdk\Endpoints\Transaction $actual
         *
         * @see https://youtrack.jetbrains.com/issue/WI-37859 - typehint required until PhpStorm recognises assertion
         */
        self::assertEquals($expected->getAmount(), $actual->getAmount());
        self::assertSame($expected->getAction(), $actual->getAction());
        self::assertSame($expected->getId(), $actual->getId());
        self::assertSame($expected->getTransactionId(), $actual->getTransactionId());

        return $actual;
    }
}
