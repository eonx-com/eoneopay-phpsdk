<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use EoneoPay\PhpSdk\Requests\Payloads\Allocation;
use EoneoPay\PhpSdk\Requests\Payloads\Token;
use EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\PrimaryRequest;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\BankAccountRequestStub;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\BankAccountTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\PrimaryRequest
 */
class DebitRequestTest extends TransactionTestCase
{
    /**
     * Make sure validation exception are expected.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testInvalidRequest(): void
    {
        $debit = new PrimaryRequest();

        try {
            $this->createClient([])->create($debit);
        } catch (Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'amount' => ['This value should not be null.'],
                    'bank_account' => ['This value should not be null.'],
                    'action' => ['This value should not be blank.'],
                    'id' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Make sure the exception structure and validation rules are thrown as expected
     * when allocation records are not provided.
     *
     * @return void
     */
    public function testInvalidRequestMissingAllocationRecords(): void
    {
        $debit = new PrimaryRequest(\array_merge(
            $this->getData(),
            [
                'action' => 'debit',
                'allocations' => new Allocation([
                    'records' => []
                ]),
                'bank_account' => new Token([
                    'token' => '7E89WDAVVWHWH83NUC26'
                ])
            ]
        ));

        try {
            $this->createClient([])->create($debit);
        } catch (Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'allocations.records' => ['You must provide at least one record.'],
                    'allocations.amount' => ['This value should not be blank.'],
                    'allocations.ewallet' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Test a successful credit card debit request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testSuccessfulCreditCardDebit(): void
    {
        $data = $this->getData();
        $debit = new PrimaryRequest(\array_merge($data, [
            'action' => 'debit',
            'bank_account' => new BankAccountRequestStub()
        ]));

        /** @var \EoneoPay\PhpSdk\Responses\Transaction $response */
        $response = $this->createClient($data)->create($debit);

        // assertions
        $this->assertTransactionResponse($data, $response);
    }

    /**
     * Test a successful tokenised credit card debit request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testSuccessfulTokenisedCreditCardDebit(): void
    {
        $data = $this->getData();
        $debit = new PrimaryRequest(\array_merge($data, [
            'action' => 'debit',
            'bank_account' => new Token([
                'token' => '7E89WDAVVWHWH83NUC26'
            ])
        ]));

        /** @var \EoneoPay\PhpSdk\Responses\Transaction $response */
        $response = $this->createClient($data)->create($debit);

        // assertions
        $this->assertTransactionResponse($data, $response);
    }
}
