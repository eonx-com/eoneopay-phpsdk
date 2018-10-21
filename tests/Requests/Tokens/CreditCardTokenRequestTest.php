<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\CreditCardTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Endpoints\Tokens\CreditCardTokenRequest
 */
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
        $data = $this->getTokenisedData();

        /** @var \EoneoPay\PhpSdk\Responses\Endpoints\Tokens\TokenisedEndpoint $response */
        $response = $this->createClient($data)->create(new CreditCardTokenRequest([
            'credit_card' => new CreditCard([
                'cvc' => '100',
                'expiry' => new Expiry(['month' => '05', 'year' => '2021']),
                'name' => 'John Wick',
                'number' => '5123450000000008'
            ])
        ]));

        self::assertSame($data['name'], $response->getName());
        self::assertSame($data['token'], $response->getToken());
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
        try {
            $this->createClient([])->create(new CreditCardTokenRequest([
                'credit_card' => new CreditCard()
            ]));
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'credit_card.expiry' => ['This value should not be blank.'],
                    'credit_card.number' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }
}
