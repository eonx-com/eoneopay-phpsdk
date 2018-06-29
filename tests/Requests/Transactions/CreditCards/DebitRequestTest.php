<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\CreditCardTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Payloads\Token;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\DebitRequest;
use EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse;
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
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ]),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'amount' => '11',
            'currency' => 'AUD',
            'id' => $id,
            'reference' => 'julian test'
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->client->create($debit);

        self::assertInstanceOf(TransactionResponse::class, $response);
        self::assertSame('11.00', $response->getAmount());
        self::assertSame('AUD', $response->getCurrency());
        self::assertSame(16, $response->getStatus());
        self::assertSame($id, $response->getId());
    }

    /**
     * Test a successful tokenised credit card debit request.
     *
     * @return void
     *
     * @throws \Exception
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

        /** @var \EoneoPay\PhpSdk\Responses\Endpoints\Tokens\TokenisedEndpoint $token */
        $token = $this->client->create($tokenise);

        $id = (string)\time();
        $debit = new DebitRequest([
            'credit_card' => new Token([
                'token' => $token->getToken()
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
    }

    /**
     * Make sure the exception structure and validation rules are thrown as expected.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testInvalidRequest(): void
    {
        $debit = new DebitRequest([]);

        try {
            $this->client->create($debit);
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'credit_card' => ['This value should not be null.'],
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
