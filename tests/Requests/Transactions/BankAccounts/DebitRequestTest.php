<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\DebitRequest;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class DebitRequestTest extends RequestTestCase
{
    /**
     * Test a successful credit card debit request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testSuccessfulCreditCardDebit(): void
    {
        $id = (string)\time();

        $debit = new DebitRequest([
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
     * Make sure validation exception are expected.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testInvalidRequest(): void
    {
        $debit = new DebitRequest();

        try {
            $this->client->create($debit);
        } catch (ValidationException $exception) {
            $expected = [
                'violations' => [
                    'bank_account' => ['This value should not be null.'],
                    'amount' => ['This value should not be blank.'],
                    'id' => ['This value should not be blank.'],
                    'gateway' => ['This value should not be null.']
                ]
            ];
            self::assertSame($expected, $exception->getErrors());
        }
    }
}
