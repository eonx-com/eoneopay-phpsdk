<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\BankAccountTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Payloads\Token;
use EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\CreditRequest;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

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
        $id = (string)\time();

        $debit = new CreditRequest([
            'bank_account' => new BankAccount([
                'bsb' => '333-333',
                'name' => 'Julian Li',
                'number' => '0876601'
            ]),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'amount' => '11',
            'currency' => 'AUD',
            'id' => $id,
            'reference' => 'julian test'
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->client->create($debit);

        self::assertSame('11.00', $response->getAmount());
        self::assertSame('AUD', $response->getCurrency());
        self::assertSame($id, $response->getId());
        self::assertSame(4, $response->getStatus());
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
        $tokenise = new BankAccountTokenRequest([
            'bank_account' => new BankAccount([
                'bsb' => '333-333',
                'name' => 'NateDaBomb',
                'number' => '0876601'
            ])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Endpoints\Tokens\TokenisedEndpoint $token */
        $token = $this->client->create($tokenise);

        $id = (string)\time();
        $credit = new CreditRequest([
            'bank_account' => new Token([
                'token' => $token->getToken()
            ]),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'amount' => '11',
            'currency' => 'AUD',
            'reference' => 'julian test',
            'id' => $id
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->client->create($credit);

        self::assertSame('11.00', $response->getAmount());
        self::assertSame('AUD', $response->getCurrency());
        self::assertSame($id, $response->getId());
        self::assertSame(4, $response->getStatus());
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
            $this->client->create($credit);
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'bank_account' => ['This value should not be null.'],
                    'amount' => ['This value should not be blank.'],
                    'id' => ['This value should not be blank.'],
                    'gateway' => ['This value should not be null.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception->getErrors());
        }
    }
}
