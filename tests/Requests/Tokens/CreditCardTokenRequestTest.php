<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\CreditCardTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class CreditCardTokenRequestTest extends RequestTestCase
{
    /**
     * Test a successful credit card tokenise request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testCreateTokenSuccessfully(): void
    {
        $tokenise = new CreditCardTokenRequest([
            'credit_card' => new CreditCard([
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Endpoints\Tokens\TokenisedEndpoint $response */
        $response = $this->client->create($tokenise);
        self::assertNotNull($response->getToken());
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
        $tokenise = new CreditCardTokenRequest([
            'credit_card' => new CreditCard()
        ]);

        try {
            $this->client->create($tokenise);
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'credit_card.expiry' => ['This value should not be blank.'],
                    'credit_card.number' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception->getErrors());
        }
    }
}
