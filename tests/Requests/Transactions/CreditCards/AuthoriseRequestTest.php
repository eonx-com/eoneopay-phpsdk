<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Payloads\Transaction;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\AuthoriseRequest;
use EoneoPay\PhpSdk\Responses\Transactions\CreditCardTransactionResponse;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestDataException;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ResponseFailedException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class AuthoriseRequestTest extends RequestTestCase
{
    /**
     * Test request failed.
     *
     * @return void
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     */
    public function testRequestFailed(): void
    {
        $this->expectException(ResponseFailedException::class);

        $authorise = new AuthoriseRequest([
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ]),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'invalid']),
            'transaction' => new Transaction([
                'amount' => '10',
                'currency' => 'AUD',
                'reference' => 'julian test',
                'request_id' => (string)\time()
            ])
        ]);

        $this->client->create($authorise);
    }

    /**
     * Test successful credit card authorise request.
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     */
    public function testSuccessfulCreditCardAuthoriseAndCapture(): void
    {
        $authorise = new AuthoriseRequest([
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ]),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'transaction' => new Transaction([
                'amount' => '10',
                'currency' => 'AUD',
                'reference' => 'julian test',
                'request_id' => (string)\time()
            ])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\CreditCardTransactionResponse $response */
        $response = $this->client->create($authorise);

        self::assertInstanceOf(CreditCardTransactionResponse::class, $response);
        self::assertSame('10.00', $response->getTransaction()->getAmount());
        self::assertTrue($response->getTransaction()->isApproved());
        self::assertFalse($response->getTransaction()->getSecurity()->isResult());
        self::assertSame('AUD', $response->getTransaction()->getCurrency());

        $capture = new AuthoriseRequest([
            'original_transaction_id' => $response->getTransaction()->getId(),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'transaction' => new Transaction([
                'amount' => '10',
                'currency' => 'AUD',
                'reference' => 'julian test',
                'request_id' => (string)\time()
            ])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\CreditCardTransactionResponse $response */
        $response = $this->client->update($capture);

        self::assertInstanceOf(CreditCardTransactionResponse::class, $response);
        self::assertSame('10.00', $response->getTransaction()->getAmount());
        self::assertTrue($response->getTransaction()->isApproved());
        self::assertFalse($response->getTransaction()->getSecurity()->isResult());
        self::assertSame('AUD', $response->getTransaction()->getCurrency());
    }

    /**
     * Test validation exception.
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     *
     * @return void
     */
    public function testValidationException(): void
    {
        $this->expectException(InvalidRequestDataException::class);
        $this->expectExceptionMessage('transaction.currency: This value is not a valid currency.');

        $authorise = new AuthoriseRequest([
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ]),
            'gateway' => new Gateway(['service' => 'default']),
            'transaction' => new Transaction([
                'amount' => '10',
                'currency' => 'AUDS',
                'reference' => 'julian test'
            ])
        ]);

        $this->client->create($authorise);
    }
}
