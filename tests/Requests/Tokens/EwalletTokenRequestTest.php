<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\EwalletTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\Ewallet;
use EoneoPay\PhpSdk\Responses\Users\EndpointTokens\EwalletToken;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\EwalletRequestStub;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\EwalletResponseStub;
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

        $response = $this->createClient($data)->create(new EwalletTokenRequest([
            'ewallet' => new EwalletRequestStub()
        ]));

        self::assertInstanceOf(EwalletToken::class, $response);
        self::assertInstanceOf(Ewallet::class, $response->getEwallet());
        $this->assertEwallet($data, $response->getEwallet());
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
            'ewallet' => (new EwalletResponseStub())->toArray(),
            'name' => 'John Wick',
            'token' => 'BGYTH232E46ZB76YXDE0'
        ];
    }
}
