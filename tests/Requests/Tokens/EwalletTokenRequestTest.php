<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\EwalletTokenRequest;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Endpoints\Tokens\EwalletTokenRequest
 */
class EwalletTokenRequestTest extends RequestTestCase
{
    /**
     * Test a successful bank account tokenise request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testCreateTokenSuccessfully(): void
    {
        $data = $this->getTokenisedData();

        /** @var \EoneoPay\PhpSdk\Responses\Users\EndpointToken $response */
        $response = $this->createClient($data)->create(new EwalletTokenRequest([
            'ewallet' => $this->getEwallet()
        ]));

        self::assertSame($data['name'], $response->getName());
        self::assertSame($data['token'], $response->getToken());
    }

    /**
     * Get tokenised ewallet data.
     *
     * @return mixed[]
     */
    protected function getTokenisedData(): array
    {
        return [
            'ewallet' => [
                'currency' => 'AUD',
                'id' => \uniqid('', false),
                'pan' => '2...H6A3',
                'reference' => '2JERVUH6A3'
            ],
            'name' => 'John Wick',
            'token' => 'BGYTH232E46ZB76YXDE0'
        ];
    }
}
