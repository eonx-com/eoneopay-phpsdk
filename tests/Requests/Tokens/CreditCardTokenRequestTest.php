<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\CreditCardTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

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

        /** @var \EoneoPay\PhpSdk\Responses\Users\EndpointToken $response */
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
        } catch (Exception $exception) {
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

    /**
     * Get tokenised credit card data.
     *
     * @return mixed[]
     */
    protected function getTokenisedData(): array
    {
        return [
            'credit_card' => [
                'country' => 'US',
                'expiry' => [
                    'month' => '05',
                    'year' => '2099'
                ],
                'id' => \uniqid('', false),
                'issue' => 'U.S. BANK NATIONAL ASSOCIATION, ND',
                'method' => 'DEBIT',
                'pan' => '5123450...0008',
                'prepaid' => null,
                'scheme' => 'Mastercard'
            ],
            'name' => 'John Wick',
            'token' => 'WCA3E4HRZXZARDB96BT6'
        ];
    }
}
