<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use EoneoPay\PhpSdk\Requests\Payloads\Token;
use EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\CreditRequest;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\BankAccountTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\CreditRequest
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

        $debit = new CreditRequest(\array_merge($data, ['bank_account' => $this->getBankAccount()]));

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->createClient($data)->create($debit);

        self::assertSame($data['amount'], $response->getAmount());
        self::assertSame($data['currency'], $response->getCurrency());
        self::assertSame($data['id'], $response->getId());
        self::assertSame('completed', $response->getStatus());
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

        $debit = new CreditRequest(\array_merge($data, [
            'bank_account' => new Token([
                'token' => '7E89WDAVVWHWH83NUC26'
            ])
        ]));

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->createClient($data)->create($debit);

        self::assertSame($data['amount'], $response->getAmount());
        self::assertSame($data['currency'], $response->getCurrency());
        self::assertSame($data['id'], $response->getId());
        self::assertSame('completed', $response->getStatus());
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
        $credit = new CreditRequest([]);

        try {
            $this->createClient([])->create($credit);
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'bank_account' => ['This value should not be null.'],
                    'amount' => ['This value should not be blank.'],
                    'id' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }
}
