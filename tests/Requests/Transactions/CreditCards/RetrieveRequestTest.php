<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Payloads\Transaction;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\DebitRequest;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\RetrieveRequest;
use EoneoPay\PhpSdk\Responses\Payloads\Transactions\CreditCardTransaction;
use EoneoPay\PhpSdk\Responses\Transactions\CreditCardTransactionResponse;
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
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ]),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'transaction' => new Transaction([
                'amount' => '11',
                'currency' => 'AUD',
                'reference' => 'julian test',
                'request_id' => (string)\time()
            ])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\CreditCardTransactionResponse $response */
        $response = $this->client->create($debit);

        $transactionId = $response->getTransaction()->getId();

        $retrieve = new RetrieveRequest([
            'transaction_id' => $response->getTransaction()->getId(),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet'])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\CreditCardTransactionResponse $response */
        $response = $this->client->get($retrieve);

        self::assertInstanceOf(CreditCardTransactionResponse::class, $response);
        self::assertInstanceOf(CreditCardTransaction::class, $response->getTransaction());
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
