<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Payloads\Transaction;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\AuthoriseRequest;
use EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestDataException;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ResponseFailedException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class AuthoriseRequestTest extends RequestTestCase
{
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

    public function testSuccessfulCreditCardAuthoriseAndCapture(): void
    {
        $authorise = new AuthoriseRequest([
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ]),
            'external_id' => (string)\time(),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'amount' => '10',
            'currency' => 'AUD',
            'reference' => 'julian test',
            'request_id' => (string)\time()
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->client->create($authorise);

        self::assertInstanceOf(TransactionResponse::class, $response);
        self::assertSame('10.00', $response->getAmount());
        self::assertSame('AUD', $response->getCurrency());

        $capture = new AuthoriseRequest([
            'id' => $response->getId(),
            'external_id' => $response->getExternalId(),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'amount' => '10',
            'currency' => 'AUD',
            'reference' => 'julian test',
            'request_id' => (string)\time()
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->client->update($capture);

        self::assertInstanceOf(TransactionResponse::class, $response);
        self::assertSame('10.00', $response->getAmount());
        self::assertSame('AUD', $response->getCurrency());
    }


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
