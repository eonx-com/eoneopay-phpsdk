<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use EoneoPay\PhpSdk\Requests\Payloads\Token;
use EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\PrimaryRequest;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\BankAccountTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\PrimaryRequest
 */
class CreditRequestTest extends RequestTestCase
{
    /**
     * Test a successful bank account credit request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testSuccessfulBankAccountCredit(): void
    {
        $data = $this->getData();

        $debit = new PrimaryRequest(\array_merge($data, [
            'action' => 'credit',
            'bank_account' => $this->getBankAccount()
        ]));

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->createClient($data)->create($debit);

        // assertions
        $this->assertTransactionResponse($data, $response);
    }

    /**
     * Test a successful tokenised bank account credit request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testSuccessfulTokenisedBankAccountCredit(): void
    {
        $data = $this->getData();

        $debit = new PrimaryRequest(\array_merge($data, [
            'action' => 'credit',
            'bank_account' => new Token([
                'token' => '7E89WDAVVWHWH83NUC26'
            ])
        ]));

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->createClient($data)->create($debit);

        // assertions
        $this->assertTransactionResponse($data, $response);
    }

    /**
     * Make sure validation exception are expected.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testInvalidRequest(): void
    {
        $credit = new PrimaryRequest([]);

        try {
            $this->createClient([])->create($credit);
        } catch (\Exception $exception) {
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
}
