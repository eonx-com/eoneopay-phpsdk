<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Endpoints\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\EwalletRequest;
use EoneoPay\PhpSdk\Requests\Payloads\Ewallet;
use EoneoPay\PhpSdk\Responses\Users\EndpointTokens\EwalletToken;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\EwalletResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Endpoints\TokenRequest
 * @covers \EoneoPay\PhpSdk\Requests\Endpoints\Tokens\EwalletRequest
 */
class EwalletRequestTest extends RequestTestCase
{
    /**
     * Test get ewallet token info successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testGetTokenInfo(): void
    {
        $data  = $this->getTokenisedData();

        $response = $this->createClient($data)->get(new EwalletRequest([
            'token' => 'BGYTH232E46ZB76YXDE0'
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
