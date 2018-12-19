<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\CreditCardTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Responses\Users\EndpointTokens\CreditCardToken;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardRequestStub;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardResponseStub;
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

        $response = $this->createClient($data)->create(new CreditCardTokenRequest([
            'credit_card' => new CreditCardRequestStub()
        ]));

        self::assertInstanceOf(CreditCardToken::class, $response);
        self::assertInstanceOf(CreditCard::class, $response->getCreditCard());
        $this->assertCreditCard($data, $response->getCreditCard());
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
            'credit_card' => (new CreditCardResponseStub())->toArray(),
            'name' => 'John Wick',
            'token' => 'WCA3E4HRZXZARDB96BT6'
        ];
    }
}
