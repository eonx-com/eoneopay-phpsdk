<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Payloads\Transaction;
use EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\DebitRequest;
use EoneoPay\PhpSdk\Responses\Transactions\BankAccountTransactionResponse;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestDataException;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ResponseFailedException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class DebitRequestTest extends RequestTestCase
{
    /**
     * Client should throw an exception if request fails.
     *
     * @return void
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     */
    public function testRequestFailed(): void
    {
        $this->expectException(ResponseFailedException::class);

        $debit = new DebitRequest([
            'bank_account' => new BankAccount([
                'bsb' => '333-333',
                'name' => 'NateDaBomb',
                'number' => '0876601'
            ]),
            'gateway' => new Gateway(['service' => 'invalid', 'line_of_business' => 'invalid']),
            'transaction' => new Transaction([
                'amount' => '11',
                'currency' => 'AUD',
                'reference' => 'julian test',
                'request_id' => (string)\time()
            ])
        ]);

        $this->client->create($debit);
    }

    /**
     * Test successful credit card debit request.
     *
     * @return void
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     */
    public function testSuccessfulCreditCardDebit(): void
    {
        $debit = new DebitRequest([
            'bank_account' => new BankAccount([
                'bsb' => '333-333',
                'name' => 'NateDaBomb',
                'number' => '0876601'
            ]),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'transaction' => new Transaction([
                'amount' => '11',
                'currency' => 'AUD',
                'reference' => 'julian test',
                'request_id' => (string)\time()
            ])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\BankAccountTransactionResponse $response */
        $response = $this->client->create($debit);

        self::assertInstanceOf(BankAccountTransactionResponse::class, $response);
        self::assertSame('11.00', $response->getTransaction()->getAmount());
        self::assertFalse($response->getTransaction()->isApproved());
        self::assertSame('AUD', $response->getTransaction()->getCurrency());
    }

    /**
     * Client should throw validation exception.
     *
     * @return void
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     */
    public function testValidationException(): void
    {
        $this->expectException(InvalidRequestDataException::class);
        $this->expectExceptionMessage('transaction.currency: This value is not a valid currency.');

        $debit = new DebitRequest([
            'bank_account' => new BankAccount([
                'bsb' => '333-333',
                'name' => 'NateDaBomb',
                'number' => '0876601'
            ]),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'transaction' => new Transaction([
                'amount' => '11',
                'currency' => 'AUDS',
                'reference' => 'julian test',
                'request_id' => (string)\time()
            ])
        ]);

        $this->client->create($debit);
    }
}
