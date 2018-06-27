<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Payloads\Transaction;
use EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\DebitRequest;
use EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\RetrieveRequest;
use EoneoPay\PhpSdk\Responses\Payloads\Transactions\BankAccountTransaction;
use EoneoPay\PhpSdk\Responses\Transactions\BankAccountTransactionResponse;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ResponseFailedException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class RetrieveRequestTest extends RequestTestCase
{
    /**
     * Client should retrieve the created transaction.
     *
     * @return void
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     */
    public function testRetrieveTransactionSuccessfully(): void
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

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->client->create($debit);

        $transactionId = $response->getTransaction()->getId();

        $retrieve = new RetrieveRequest([
            'transaction_id' => $response->getTransaction()->getId(),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet'])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->client->get($retrieve);

        self::assertInstanceOf(BankAccountTransactionResponse::class, $response);
        self::assertInstanceOf(BankAccountTransaction::class, $response->getTransaction());
        self::assertEquals($transactionId, $response->getTransaction()->getId());
    }

    /**
     * Client should throw an exception if transaction not found.
     *
     * @return void
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     */
    public function testTransactionNotFound(): void
    {
        $this->expectException(ResponseFailedException::class);

        $retrieve = new RetrieveRequest([
            'transaction_id' => 'invalid',
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet'])
        ]);

        $this->client->get($retrieve);
    }
}
