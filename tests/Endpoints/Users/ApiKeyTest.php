<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\Users\ApiKey;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Users\ApiKey
 */
class ApiKeyTest extends TestCase
{
    /***
     * Base test to check class exists
     *
     * @return void
     */
    public function testClassExists(): void
    {
        $class = new ApiKey();

        self::assertInstanceOf(ApiKey::class, $class);
    }

    /**
     * Test Create a key successfully
     *
     * @return  void
     */
    public function testCreateKey(): void
    {
        $apiKey = $this->createApiManager(['key' => 'XXJ3DEG8FH49TNR3'])
            ->getRepository(ApiKey::class)
            ->createKey((string)\getenv('PAYMENTS_API_KEY'), 'external-user-id');

        self::assertSame('XXJ3DEG8FH49TNR3', $apiKey->getKey());
    }

    /**
     * Test remove key
     *
     * @return void
     */
    public function testRemoveKey(): void
    {
        $apiKey = $this->createApiManager(null, 204)
            ->getRepository(ApiKey::class)
            ->deleteKey((string)\getenv('PAYMENTS_API_KEY'), 'RHMCY4H9B7X69AW4');

        self::assertIsBool($apiKey);
    }
}