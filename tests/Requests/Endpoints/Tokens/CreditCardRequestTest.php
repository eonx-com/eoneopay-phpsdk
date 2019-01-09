<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Endpoints\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\CreditCardRequest;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Responses\Users\EndpointTokens\CreditCardToken;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Endpoints\TokenRequest
 * @covers \EoneoPay\PhpSdk\Requests\Endpoints\Tokens\CreditCardRequest
 */
class CreditCardRequestTest extends RequestTestCase
{
    /**
     * Test get credit card token info successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testGetTokenInfo(): void
    {
        $data = $this->getTokenisedData();

        $response = $this->createClient($data)->get(new CreditCardRequest([
            'token' => 'WCA3E4HRZXZARDB96BT6'
        ]));

        self::assertInstanceOf(CreditCardToken::class, $response);
        self::assertInstanceOf(CreditCard::class, $response->getCreditCard());
        $this->assertCreditCard($data, $response->getCreditCard());
        self::assertSame($data['name'], $response->getName());
        self::assertSame($data['token'], $response->getToken());
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
