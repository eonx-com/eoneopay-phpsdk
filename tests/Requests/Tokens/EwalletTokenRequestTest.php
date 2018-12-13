<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\EwalletTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\Ewallet;
use EoneoPay\PhpSdk\Responses\Users\EndpointTokens\EwalletToken;
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
            'ewallet' => $this->getEwallet()
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

    /**
     * Ewallet assertions.
     *
     * @param mixed[] $data Expectations
     * @param \EoneoPay\PhpSdk\Requests\Payloads\Ewallet $ewallet Ewallet payload response
     *
     * @return void
     */
    private function assertEwallet(array $data, Ewallet $ewallet): void
    {
        self::assertSame($data['ewallet']['currency'], $ewallet->getCurrency());
        self::assertSame($data['ewallet']['id'], $ewallet->getId());
        self::assertSame($data['ewallet']['pan'], $ewallet->getPan());
        self::assertSame($data['ewallet']['reference'], $ewallet->getReference());
    }
}
