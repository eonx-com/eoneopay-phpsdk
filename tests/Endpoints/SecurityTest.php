<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\Security;
use EoneoPay\PhpSdk\Exceptions\RuntimeException;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Security
 */
final class SecurityTest extends TestCase
{
    /**
     * Simple test count number of uri's used.
     *
     * @return void
     */
    public function testCountUri(): void
    {
        $security = new Security();
        self::assertCount(2, $security->uris());
    }

    /**
     * Test initiate a security call.
     *
     * @return void
     */
    public function testInitiateSecurity(): void
    {
        $response = [
            'action_url' => 'https://bne-stripe1.ap.gateway.mastercard.com/',
            'amount' => [
                'currency' => 'AUD',
                'total' => '90.00',
            ],
            'authentication_result' => null,
            'cavv' => null,
            'created_at' => '2019-02-25T04=>59=>18Z',
            'eci' => null,
            'enrolment_status' => 'Y',
            'id' => 'external-security-id',
            'metadata' => [],
            'payment_source' => [
                'bin' => [
                    'bin' => '512345',
                    'category' => 'Standard',
                    'country' => 'EC',
                    'created_at' => '2019-02-13T22=>10=>24Z',
                    'funding_source' => 'CREDIT',
                    'issuer' => 'BANCO DEL PICHINCHA, C.A.',
                    'prepaid' => null,
                    'scheme' => 'MASTERCARD',
                    'updated_at' => '2019-02-13T22=>10=>24Z',
                ],
                'created_at' => '2019-02-22T03=>08=>07Z',
                'expiry' => [
                    'month' => '11',
                    'year' => '2099',
                ],
                'facility' => 'Mastercard',
                'id' => '1a05c6ac43c7a93088a7bff15e3625f4',
                'name' => 'User Name',
                'pan' => '512345...0008',
                'token' => 'JED4DKKFRRDM9WWJD9B9',
                'type' => 'credit_card',
                'updated_at' => '2019-02-22T03=>08=>13Z',
            ],
            'request_payload' => 'dummy-payload',
            'response_payload' => null,
            'return_url' => 'https=>//your-url/3dsecure',
            'secured' => null,
            'status' => 'pending',
            'updated_at' => '2019-02-25T04=>59=>24Z',
            'xid' => 'HVYed7tXDxWoIDZy7HDR3CfVJOw=',
        ];
        $security = $this->createApiManager($response, 200)
            ->create((string)\getenv('PAYMENTS_API_KEY'), new Security([
                'id' => 'external-security-id',
                'amount' => [
                    'currency' => 'AUD',
                    'total' => '90.00',
                ],
                'payment_source' => [
                    'token' => 'credit-card-token',
                    'type' => 'credit_card',
                ],
                'return_url' => 'https://your-url/3dsecure',
            ]));

        self::assertIsString(($security instanceof Security) ? $security->getActionUrl() : null);
    }

    /**
     * Test verify security throws Runtime exception on invalid payload.
     *
     * @return void
     */
    public function testVerifySecurityExceptionOnInvalidPayload(): void
    {
        $this->expectException(RuntimeException::class);
        $this->createApiManager(
            [
                'code' => 5242,
                'message' => 'Invalid payload or security validation response received.',
                'sub_code' => 1,
                'time' => '2019-02-26T03=>01=>47Z',
            ],
            500
        )->update((string)\getenv('PAYMENTS_API_KEY'), new Security([
            'id' => 'external-security-id',
            'payload' => 'payload',
        ]));
    }
}
