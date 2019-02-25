<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet;
use EoneoPay\PhpSdk\Endpoints\Transaction;
use EoneoPay\PhpSdk\Endpoints\User;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Transaction
 */
class PrimaryTransactionsTest extends TestCase
{
    /**
     * Test authorise transaction successfully.
     *
     * @return void
     */
    public function testAuthoriseSuccessfully(): void
    {
        $data = $this->createResponse([
            'action' => Transaction::ACTION_AUTHORISE
        ]);

        $expected = new Transaction(\array_merge($data, [
            'paymentSource' => new CreditCard($data['paymentSource'])
        ]));

        $actual = $this->createApiManager($this->createResponse($data))
            ->create((string)\getenv('PAYMENTS_API_KEY'), $expected);

        self::assertInstanceOf(Transaction::class, $actual);
        $this->performAssertions($expected, $actual);
        self::assertInstanceOf(CreditCard::class, $actual->getPaymentSource());
        self::assertInstanceOf(Ewallet::class, $actual->getPaymentDestination());
    }

    /**
     * Test debit transaction successfully.
     *
     * @return void
     */
    public function testDebitSuccessfully(): void
    {
        $data = $this->createResponse([
            'action' => Transaction::ACTION_DEBIT,
            'paymentSource' => [
                'token' => \mb_strtoupper($this->generateId()),
                'type' => 'bank_account'
            ]
        ]);

        $expected = new Transaction(\array_merge($data, [
            'paymentSource' => new BankAccount($data['paymentSource'])
        ]));

        $actual = $this->createApiManager($this->createResponse($data))
            ->create((string)\getenv('PAYMENTS_API_KEY'), $expected);

        self::assertInstanceOf(Transaction::class, $actual);
        $this->performAssertions($expected, $actual);
        self::assertInstanceOf(BankAccount::class, $actual->getPaymentSource());
        self::assertInstanceOf(Ewallet::class, $actual->getPaymentDestination());
    }

    /**
     * Test credit transaction successfully.
     *
     * @return void
     */
    public function testCreditSuccessfully(): void
    {
        $data = $this->createResponse([
            'action' => Transaction::ACTION_CREDIT,
            'paymentDestination' => [
                'token' => \mb_strtoupper($this->generateId()),
                'type' => 'bank_account'
            ]
        ]);

        $expected = new Transaction(\array_merge($data, [
            'paymentDestination' => new BankAccount($data['paymentDestination'])
        ]));

        $actual = $this->createApiManager(\array_merge($data, [
            'paymentSource' => [
                'id' => \uniqid('', false),
                'pan' => '2...H6A3',
                'type' => 'ewallet'
            ]
        ]))->create((string)\getenv('PAYMENTS_API_KEY'), $expected);

        self::assertInstanceOf(Transaction::class, $actual);
        $this->performAssertions($expected, $actual);
        self::assertInstanceOf(Ewallet::class, $actual->getPaymentSource());
        self::assertInstanceOf(BankAccount::class, $actual->getPaymentDestination());
    }

    /**
     * Perform assertions.
     *
     * @param \EoneoPay\PhpSdk\Endpoints\Transaction $expected
     * @param \EoneoPay\PhpSdk\Endpoints\Transaction $actual
     *
     * @return void
     */
    private function performAssertions(Transaction $expected, Transaction $actual): void
    {
        self::assertSame($expected->getAmount(), $actual->getAmount());
        self::assertSame($expected->getAction(), $actual->getAction());
        self::assertSame($expected->getId(), $actual->getId());
        self::assertSame($expected->getTransactionId(), $actual->getTransactionId());
    }

    /**
     * Create transaction response.
     *
     * @param mixed[]|null $data
     *
     * @return array
     */
    private function createResponse(?array $data = null): array
    {
        return \array_merge([
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
}
