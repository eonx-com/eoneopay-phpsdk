<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Payloads\Transaction;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\DebitRequest;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\RefundRequest;
use EoneoPay\PhpSdk\Responses\Payloads\Transactions\CreditCardTransaction;
use EoneoPay\PhpSdk\Responses\Transactions\CreditCardTransactionResponse;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ResponseFailedException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class RefundRequestTest extends RequestTestCase
{
    /**
     * Client should refund the created transaction.
     *
     * @return void
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     */
    public function testRefundTransactionSuccessfully(): void
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

        $refund = new RefundRequest([
            'transaction_id' => $response->getTransaction()->getId(),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'transaction' => new Transaction([
                'amount' => '11',
                'currency' => 'AUD',
                'reference' => 'julian test',
                'request_id' => (string)\time()
            ])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\CreditCardTransactionResponse $response */
        $response = $this->client->delete($refund);

        self::assertInstanceOf(CreditCardTransactionResponse::class, $response);
        self::assertInstanceOf(CreditCardTransaction::class, $response->getTransaction());
        self::assertNotNull($response->getTransaction()->getId());
        self::assertEquals('refund', $response->getTransaction()->getAction());
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

        $refund = new RefundRequest([
            'transaction_id' => 'invalid',
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'transaction' => new Transaction([
                'amount' => '11',
                'currency' => 'AUD',
                'reference' => 'julian test',
                'request_id' => (string)\time()
            ])
        ]);

        $this->client->delete($refund);
    }
}
