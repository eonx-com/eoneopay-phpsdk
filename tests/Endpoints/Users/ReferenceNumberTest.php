<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\Users\ReferenceNumber;
use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Users\ReferenceNumber
 */
class ReferenceNumberTest extends TestCase
{
    /***
     * Base test to check class exists
     *
     * @return void
     */
    public function testClassExists(): void
    {
        $class = new ReferenceNumber();

        self::assertInstanceOf(ReferenceNumber::class, $class);
    }

    /**
     * Test that a reference is created successfully
     *
     * @return  void
     */
    public function testCreateReference(): void
    {
        /** @var \EoneoPay\PhpSdk\Endpoints\Users\ReferenceNumber $reference */
        $reference = $this->getApi()->create((string)\getenv('PAYMENTS_API_KEY'), new ReferenceNumber(
            [
                'ewallet' => [
                    'reference' => '2JERVUH6A3'
                ],
                'type' => 'bpay'
            ]
        ));

        // Assert that the instance matches
        self::assertInstanceOf(ReferenceNumber::class, $reference);

        // Assert that the reference number is 10 digits
        self::assertRegExp('/\d{10}/', $reference->getReferenceNumber());
    }

    /**
     * Test that the generated URIs match what we are expecting
     *
     * @return void
     */
    public function testUrisGenerateCorrectly(): void
    {
        $uris = $this->getApi()->create((string)\getenv('PAYMENTS_API_KEY'), new ReferenceNumber(
            [
                'ewallet' => [
                    'reference' => '2JERVUH6A3'
                ],
                'type' => 'bpay',
                'userId' => 'user1'
            ]
        ))->uris();

        $expected = [
            EntityInterface::CREATE => '/\/users\/[A-Za-z0-9]+\/reference/'
        ];

        // Assert that each generated URI matches the regular expression
        foreach ($expected as $method => $regex) {
            self::assertArrayHasKey($method, $uris);
            self::assertRegExp($regex, $uris[$method]);
        }
    }

    /**
     * Gets the test API manager instance
     *
     * @return \EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface
     */
    private function getApi(): EoneoPayApiManagerInterface
    {
        return $this->createApiManager(
            [
                'allocationEwallet' => [
                    'created_at' => '2019-04-01T00:48:20Z',
                    'currency' => 'AUD',
                    'id' => '729a8c888e89bd2d1e19bc6c5108b5eb',
                    'pan' => '2...H6A3',
                    'primary' => true,
                    'reference' => '2JERVUH6A3',
                    'type' => 'ewallet',
                    'updated_at' => '2019-04-01T23:34:11Z',
                    'user' => [
                        'created_at' => '2019-04-01T23:34:11Z',
                        'email' => 'user@example.com',
                        'updated_at' => '2019-04-01T23:34:11Z'
                    ]
                ],
                'created_at' => '2019-02-28T05:43:31Z',
                'ewallet' => [
                    'created_at' => '2019-04-01T23:34:11Z',
                    'currency' => 'AUD',
                    'id' => '6e967a8e9971aab24d2db4e932ca1a06',
                    'pan' => 'Y...K8Y7',
                    'primary' => true,
                    'reference' => 'YNGANFK8Y7',
                    'type' => 'ewallet',
                    'updated_at' => '2019-04-01T23:34:11Z',
                    'user' => [
                        'created_at' => '2019-04-01T23:34:11Z',
                        'email' => 'user@example.com',
                        'updated_at' => '2019-04-01T23:34:11Z'
                    ]
                ],
                'reference_number' => '2757767146',
                'updated_at' => '2019-03-04T03:19:03Z',
                'user' => [
                    'created_at' => '2019-04-01T23:34:11Z',
                    'email' => 'user@example.com',
                    'updated_at' => '2019-04-01T23:34:11Z'
                ]
            ],
            200
        );
    }
}
