<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Repositories\Users;

use EoneoPay\PhpSdk\Endpoints\Users\ApiKey;
use EoneoPay\PhpSdk\Exceptions\ClientException;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers EoneoPay\PhpSdk\Repositories\Users\ApiKeyRepository
 */
class ApiKeyRepositoryTest extends TestCase
{

    /**
     * Test if key returned is a string and not empty
     *
     * @return void
     */
    public function testCreateKey(): void
    {
        $apiKey = $this->createApiManager(['key' => 'XXJ3DEG8FH49TNR3'])
            ->getRepository(ApiKey::class)
            ->createKey((string)\getenv('PAYMENTS_API_KEY'), 'external-user-id');

        self::assertIsString($apiKey->getKey());
        self::assertNotEmpty($apiKey->getKey());
    }


    /**
     * Test if exception is thrown on bad response
     *
     * @return void
     */
    public function testCreateThrowsException(): void
    {
        $this->expectException(ClientException::class);
        $this->createApiManager(
            [
                'code' => 4404,
                'message' => 'Target user cannot be found or has terminated the relationship.'
            ],
            404
        )
            ->getRepository(ApiKey::class)
            ->createKey((string)\getenv('PAYMENTS_API_KEY'), 'external-user-id');
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

    /**
     * Test if exception is thrown on bad response
     *
     * @return void
     */
    public function testRemoveThrowsException(): void
    {
        $this->expectException(ClientException::class);
        $this->createApiManager(
            [
                'code' => 4404,
                'message' => 'Target user cannot be found or has terminated the relationship.'
            ],
            404
        )
            ->getRepository(ApiKey::class)
            ->deleteKey((string)\getenv('PAYMENTS_API_KEY'), 'external-user-id');
    }
}
