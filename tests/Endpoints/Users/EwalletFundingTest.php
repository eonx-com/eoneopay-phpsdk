<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\Ewallet;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard;
use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Endpoints\Users\EwalletFunding;
use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use Tests\EoneoPay\PhpSdk\TestCases\ValidationEnabledTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Users\EwalletFunding
 */
class EwalletFundingTest extends ValidationEnabledTestCase
{
    /**
     * Base test to check class constructs as expected.
     *
     * @return void
     */
    public function testClassConstructor(): void
    {
        $fundingSource = new CreditCard();
        $ewallet = new Ewallet();
        $class = new EwalletFunding([
            'ewallet' => $ewallet,
            'fundingSource' => $fundingSource,
            'id' => 'FUNDING_ID',
            'targetAmount' => '100.00',
            'threshold' => '20.00',
        ]);

        self::assertSame($ewallet, $class->getEwallet());
        self::assertSame($fundingSource, $class->getFundingSource());
        self::assertSame('FUNDING_ID', $class->getId());
        self::assertSame('100.00', $class->getTargetAmount());
        self::assertSame('20.00', $class->getThreshold());
    }

    /**
     * Test that creating an ewallet funding returns expected response.
     *
     * @return void
     */
    public function testCreateEwalletFunding(): void
    {
        $fundingSource = new CreditCard();
        $ewallet = new Ewallet();
        $class = new EwalletFunding([
            'ewallet' => $ewallet,
            'primaryEndpoint' => $fundingSource,
            'id' => 'FUNDING_ID',
            'targetAmount' => '100.00',
            'threshold' => '20.00',
        ]);

        $expected = new EwalletFunding([
            'endpoints' => [
                new CreditCard([
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
                    'token' => 'BBEJ6JGRHAZ2KUBD89C3',
                    'type' => 'credit_card',
                    'updated_at' => '2019-02-22T03=>08=>13Z',
                ]),
            ],
            'ewallet' => new Ewallet([
                'created_at' => '2019-04-01T23:34:11Z',
                'currency' => 'AUD',
                'id' => '6e967a8e9971aab24d2db4e932ca1a06',
                'pan' => 'Y...K8Y7',
                'primary' => true,
                'reference' => 'YNGANFK8Y7',
                'type' => 'ewallet',
                'updated_at' => '2019-04-01T23:34:11Z',
                'user' => new User([
                    'created_at' => '2019-04-01T23:34:11Z',
                    'email' => 'user@example.com',
                    'updated_at' => '2019-04-01T23:34:11Z',
                ]),
            ]),
            'targetAmount' => '100.00',
            'threshold' => '20.00',
        ]);

        $apiKey = (string)\getenv('PAYMENTS_API_KEY');
        $response = $this->getApi()->create($apiKey, $class);

        self::assertInstanceOf(EwalletFunding::class, $response);
        /** @var \EoneoPay\PhpSdk\Endpoints\Users\EwalletFunding $response */
        self::assertEquals($expected, $response);
        self::assertSame('100.00', $response->getTargetAmount());
        self::assertSame('20.00', $response->getThreshold());
    }

    /**
     * Test ewallet funding endpoint validation.
     *
     * @return void
     */
    public function testEndpointValidation(): void
    {
        $class = new EwalletFunding();

        $expected = <<<'ERR'
Object(EoneoPay\PhpSdk\Endpoints\Users\EwalletFunding).ewallet:
    This value should not be null. (code ad32d13f-c3d4-423b-909a-857b961eb720)
Object(EoneoPay\PhpSdk\Endpoints\Users\EwalletFunding).id:
    This value should not be null. (code ad32d13f-c3d4-423b-909a-857b961eb720)
Object(EoneoPay\PhpSdk\Endpoints\Users\EwalletFunding).fundingSource:
    This value should not be null. (code ad32d13f-c3d4-423b-909a-857b961eb720)
Object(EoneoPay\PhpSdk\Endpoints\Users\EwalletFunding).targetAmount:
    This value should not be blank. (code c1051bb4-d103-4f74-8988-acbcafc7fdc3)
Object(EoneoPay\PhpSdk\Endpoints\Users\EwalletFunding).threshold:
    This value should not be blank. (code c1051bb4-d103-4f74-8988-acbcafc7fdc3)

ERR;
        $validator = $this->getValidator();
        $violations = $validator->validate($class);

        $this->assertConstraints($expected, $violations);
    }

    /**
     * Test remove ewallet funding successfully.
     *
     * @return void
     */
    public function testRemove(): void
    {
        $funding = new EwalletFunding([
            'ewallet' => new Ewallet([
                'reference' => 'EWALLETREF',
            ]),
            'id' => 'FUNDING_ID',
        ]);
        $apiKey = (string)\getenv('PAYMENTS_API_KEY');
        $response = $this->createApiManager(null, 204)->delete($apiKey, $funding);

        self::assertNull($response);
    }

    /**
     * Gets the test API manager instance.
     *
     * @return \EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface
     */
    private function getApi(): EoneoPayApiManagerInterface
    {
        return $this->createApiManager(
            [
                'created_at' => '2019-02-28T05:43:31Z',
                'endpoints' => [
                    [
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
                        'token' => 'BBEJ6JGRHAZ2KUBD89C3',
                        'type' => 'credit_card',
                        'updated_at' => '2019-02-22T03=>08=>13Z',
                    ],
                ],
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
                        'updated_at' => '2019-04-01T23:34:11Z',
                    ],
                ],
                'targetAmount' => '100.00',
                'threshold' => '20.00',
                'updated_at' => '2019-03-04T03:19:03Z',
            ],
            201
        );
    }
}
