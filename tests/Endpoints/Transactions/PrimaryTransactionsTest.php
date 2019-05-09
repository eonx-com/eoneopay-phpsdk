<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Transactions;

use EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet;
use EoneoPay\PhpSdk\Endpoints\Transaction;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Transaction
 */
class PrimaryTransactionsTest extends TransactionTestCase
{
    /**
     * Test allocation transfer transaction successfully.
     *
     * @return void
     */
    public function testAllocationTransactionFundingSource(): void
    {
        $data = $this->createResponse([
            'action' => Transaction::ACTION_TRANSFER,
            'paymentSource' => [
                'token' => \mb_strtoupper($this->generateId()),
                'type' => 'ewallet'
            ],
            'paymentDestination' => [
                'token' => \mb_strtoupper($this->generateId()),
                'type' => 'ewallet'
            ],
            'fundingSource' => [
                'country' => 'AU',
                'currency' => 'AUD',
                'name' => 'John Wick',
                'pan' => '123-456...4321',
                'prefix' => '123-456',
                'token' => \mb_strtoupper($this->generateId()),
                'type' => 'bank_account'
            ]
        ]);

        $expected = new Transaction(\array_merge($data, [
            'paymentSource' => new Ewallet($data['paymentSource'])
        ]));

        $actual = $this->createApiManager($this->createResponse($data))
            ->create((string)\getenv('PAYMENTS_API_KEY'), $expected);

        $this->performTransactionAssertions($expected, $actual);
        self::assertInstanceOf(
            Ewallet::class,
            ($actual instanceof Transaction) === true ? $actual->getPaymentSource() : null
        );
        self::assertInstanceOf(
            Ewallet::class,
            ($actual instanceof Transaction) === true ? $actual->getPaymentDestination() : null
        );
        self::assertInstanceOf(
            BankAccount::class,
            ($actual instanceof Transaction) === true ? $actual->getFundingSource() : null
        );
    }

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

        $this->performTransactionAssertions($expected, $actual);
        self::assertInstanceOf(
            Ewallet::class,
            ($actual instanceof Transaction) === true ? $actual->getPaymentSource() : null
        );
        self::assertInstanceOf(
            BankAccount::class,
            ($actual instanceof Transaction) === true ? $actual->getPaymentDestination() : null
        );
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

        $this->performTransactionAssertions($expected, $actual);
        self::assertInstanceOf(
            BankAccount::class,
            ($actual instanceof Transaction) === true ? $actual->getPaymentSource() : null
        );
        self::assertInstanceOf(
            Ewallet::class,
            ($actual instanceof Transaction) === true ? $actual->getPaymentDestination() : null
        );
    }

    /**
     * Test ewallet to ewallet transfer successfully.
     *
     * @return void
     */
    public function testTransferSuccessfully(): void
    {
        $data = $this->createResponse([
            'action' => Transaction::ACTION_TRANSFER,
            'paymentDestination' => [
                'id' => \uniqid('', false),
                'pan' => 'D...T001',
                'token' => \mb_strtoupper($this->generateId()),
                'type' => 'ewallet'
            ],
            'paymentSource' => [
                'id' => \uniqid('', false),
                'pan' => 'K...WCB7',
                'token' => \mb_strtoupper($this->generateId()),
                'type' => 'ewallet'
            ]
        ]);

        $expected = new Transaction(\array_merge($data, [
            'paymentDestination' => new Ewallet($data['paymentDestination']),
            'paymentSource' => new Ewallet($data['paymentSource'])
        ]));

        $actual = $this->createApiManager($data)->create((string)\getenv('PAYMENTS_API_KEY'), $expected);

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
}
