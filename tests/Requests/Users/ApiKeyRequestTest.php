<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Requests\Users\ApiKeys\CreateRequest;
use EoneoPay\PhpSdk\Requests\Users\ApiKeys\RevokeRequest;
use EoneoPay\PhpSdk\Responses\Users\ApiKey;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Users\ApiKeys\CreateRequest
 * @covers \EoneoPay\PhpSdk\Requests\Users\ApiKeys\RevokeRequest
 */
class ApiKeyRequestTest extends RequestTestCase
{
    /**
     * Test create will fail with exception if user id is not provided
     *
     * @return void
     */
    public function testCreateFailsWithException(): void
    {
        try {
            $this->createClient([])->create(new CreateRequest([]));
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'id' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Test create api key for a user.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testCreateSuccessfully(): void
    {
        /** @var \EoneoPay\PhpSdk\Responses\Users\ApiKey $apiKey */
        $apiKey = $this->createClient([
            'key' => \uniqid('', false)
        ])->create(new CreateRequest([
            'id' => 'dodgyUser5'
        ]));

        self::assertInstanceOf(ApiKey::class, $apiKey);
        self::assertNotNull($apiKey->getKey());
    }

    /**
     * Test revoke will fail with exception when id and/or key is not provided.
     *
     * @return void
     */
    public function testRevokeFailsWithException(): void
    {
        try {
            $this->createClient([])->delete(new RevokeRequest([]));
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'id' => ['This value should not be blank.'],
                    'key' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Test revoke an api key.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testRevokeSuccessfully(): void
    {
        $apiKey = $this->createClient([])->delete(new RevokeRequest([
            'id' => 'dodgyUser5',
            'key' => 'EJCCCCY73DKAKDND'
        ]));

        self::assertNull($apiKey);
    }
}
