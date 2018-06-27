<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Payloads\Token;
use EoneoPay\PhpSdk\Requests\Payloads\Transaction;
use EoneoPay\PhpSdk\Requests\Tokens\CreditCardTokenRequest;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\DebitRequest;
use EoneoPay\PhpSdk\Responses\Payloads\TokenisedCreditCard;
use EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse;
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
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ]),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'invalid']),
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

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->client->create($debit);

        self::assertInstanceOf(TransactionResponse::class, $response);
        self::assertSame('11.00', $response->getTransaction()->getAmount());
        self::assertTrue($response->getTransaction()->isApproved());
        self::assertFalse($response->getTransaction()->getSecurity()->isResult());
        self::assertSame('AUD', $response->getTransaction()->getCurrency());
    }

    /**
     * Test successful tokenised credit card debit request.
     *
     * @return void
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     */
    public function testSuccessfulTokenisedCreditCardDebit(): void
    {
        $tokenise = new CreditCardTokenRequest([
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Payloads\TokenisedCreditCard $token */
        $token = $this->client->create($tokenise);

        self::assertInstanceOf(TokenisedCreditCard::class, $token);

        $debit = new DebitRequest([
            'credit_card' => new Token([
                'token' => $token->getId()
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

        self::assertInstanceOf(TransactionResponse::class, $response);
        self::assertSame('11.00', $response->getTransaction()->getAmount());
        self::assertTrue($response->getTransaction()->isApproved());
        self::assertFalse($response->getTransaction()->getSecurity()->isResult());
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
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
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
