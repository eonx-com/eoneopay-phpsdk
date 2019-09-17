<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Endpoints\Users\ApiKey;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Users\ApiKey
 */
final class ApiKeyTest extends TestCase
{
    /**
     * Base test to check class exists.
     *
     * @return void
     */
    public function testClassExists(): void
    {
        $class = new ApiKey();

        self::assertInstanceOf(ApiKey::class, $class);
    }

    /**
     * Test Create a key successfully.
     *
     * @return  void
     */
    public function testCreateKey(): void
    {
        $apiKey = $this->createApiManager(
            [
                'created_at' => '2019-02-25T23=>36=>48Z',
                'key' => 'PNYH33ZHKVX3HBAT',
                'target_user' => [
                    'created_at' => '2019-02-24T23=>34=>11Z',
                    'email' => 'examples@user.test',
                    'id' => 'external-user-ids',
                    'updated_at' => '2019-02-24T23=>34=>11Z',
                ],
                'updated_at' => '2019-02-25T23=>36=>48Z',
                'user' => [
                    'created_at' => '2019-02-12T22=>08=>30Z',
                    'email' => 'payments@eoneopay.com',
                    'updated_at' => '2019-02-12T22=>08=>30Z',
                ],
            ],
            201
        )
            ->create(
                (string)\getenv('PAYMENTS_API_KEY'),
                new ApiKey(['user' => new User(['id' => 'external-user-id'])])
            );

        self::assertIsString(($apiKey instanceof ApiKey) ? $apiKey->getKey() : null);
        self::assertInstanceOf(User::class, ($apiKey instanceof ApiKey) ? $apiKey->getUser() : null);
    }

    /**
     * Test remove key.
     *
     * @return void
     */
    public function testRemoveKey(): void
    {
        $apiKey = $this->createApiManager(null, 204)
            ->delete(
                (string)\getenv('PAYMENTS_API_KEY'),
                new ApiKey(['user' => new User(['id' => 'external-user-id'])])
            );

        self::assertNull($apiKey);
    }
}
