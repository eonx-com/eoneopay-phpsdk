<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Factories;

use EoneoPay\PhpSdk\Exceptions\InvalidResponseContentType;
use EoneoPay\PhpSdk\Factories\ResponseFactory;
use EoneoPay\PhpSdk\Responses\User;
use Tests\EoneoPay\PhpSdk\TestCases\TestCase;

class ResponseFactoryTest extends TestCase
{
    /**
     * Test the factory create method
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\InvalidResponseClass
     * @throws \EoneoPay\PhpSdk\Exceptions\InvalidResponseContentType
     */
    public function testCreate(): void
    {
        $factory = $this->createInstance();

        /** @var \EoneoPay\PhpSdk\Responses\User $response */
        $response = $factory->create(User::class, \json_encode(['id' => 'aUserId', 'email' => 'acb@email.com']));

        self::assertInstanceOf(User::class, $response);

        self::assertSame('aUserId', $response->getId());
        self::assertSame('acb@email.com', $response->getEmail());
    }

    /**
     * Test the factory create method will throw an Exception if provided data is not encoded JSON
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\InvalidResponseClass
     * @throws \EoneoPay\PhpSdk\Exceptions\InvalidResponseContentType
     */
    public function testCreateThrowsExceptionIfNotEncodedJson(): void
    {
        $this->expectException(InvalidResponseContentType::class);
        $this->expectExceptionMessage('Expected JSON content type');

        $factory = $this->createInstance();

        $response = $factory->create(User::class, '<xml></xml>');

        self::assertInstanceOf(User::class, $response);
    }

    /**
     * Instantiate a response factory
     *
     * @return \EoneoPay\PhpSdk\Factories\ResponseFactory
     */
    private function createInstance(): ResponseFactory
    {
        return new ResponseFactory();
    }
}
