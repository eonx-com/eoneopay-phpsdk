<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\TestCases;

use EoneoPay\PhpSdk\Endpoints\Transaction;
use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Interfaces\Endpoints\TransactionInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @coversNothing
 */
class TransactionTestCase extends TestCase
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
                'total' => '100.00'
            ],
            'id' => \uniqid('ord', false),
            'paymentSource' => [
                'token' => 'VRG2VR4F39343HM4D3N2',
                'type' => 'credit_card'
            ],
            'transactionId' => \uniqid('txn', false),
            'paymentDestination' => [
                'id' => \uniqid('', false),
                'pan' => '2...H6A3',
                'type' => 'ewallet'
            ],
            'statementDescription' => 'PAYMENT GATEWAY',
            'user' => new User([
                'email' => 'user@email.test'
            ])
        ], $data ?? []);
    }

    /**
     * Perform transaction assertions.
     *
     * @param \EoneoPay\PhpSdk\Endpoints\Transaction $expected
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $actual
     *
     * @return void
     */
    protected function performTransactionAssertions(Transaction $expected, EntityInterface $actual): void
    {
        self::assertInstanceOf(Transaction::class, $actual);
        self::assertSame(
            $expected->getAmount(),
            ($actual instanceof Transaction) === true ? $actual->getAmount() : null
        );
        self::assertSame(
            $expected->getAction(),
            ($actual instanceof Transaction) === true ? $actual->getAction() : null
        );
        self::assertSame(
            $expected->getId(),
            ($actual instanceof Transaction) === true ? $actual->getId() : null
        );
        self::assertSame(
            $expected->getTransactionId(),
            ($actual instanceof Transaction) === true ? $actual->getTransactionId() : null
        );
    }
}
