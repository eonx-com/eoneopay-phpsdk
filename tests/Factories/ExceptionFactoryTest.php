<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Factories;

use EoneoPay\PhpSdk\Exceptions\ClientException;
use EoneoPay\PhpSdk\Exceptions\CriticalException;
use EoneoPay\PhpSdk\Exceptions\RuntimeException;
use EoneoPay\PhpSdk\Exceptions\ValidationException;
use EoneoPay\PhpSdk\Factories\ExceptionFactory;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\ResponseInterface;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Factories\ExceptionFactory
 */
class ExceptionFactoryTest extends TestCase
{
    /**
     * Test create exceptions
     *
     * @return void
     */
    public function testCreate(): void
    {

        $data = '{"code" : 1999, "message" : "internal system error"}';
        self::assertInstanceOf(CriticalException::class, $this->createException($data));

        $data = '{"code" : 6000, "message" : "internal system error"}';
        self::assertInstanceOf(ValidationException::class, $this->createException($data));

        $data = '{"code" : 5000, "message" : "internal system error"}';
        self::assertInstanceOf(RuntimeException::class, $this->createException($data));

        $data = '{"code" : 4000, "message" : "internal system error"}';
        self::assertInstanceOf(ClientException::class, $this->createException($data));
    }

    /**
     * Create exception based on response data
     *
     * @param string $data Response data as json
     *
     * @return \Exception
     */
    private function createException(string $data): Exception
    {
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject
         */
        $mockResponse = $this->createMock(ResponseInterface::class);
        $mockResponse->method('getContent')->willReturn($data);
        /**
         * @var \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\ResponseInterface
         */
        $response = $mockResponse;

        $responseException = new InvalidApiResponseException($response);
        return (new ExceptionFactory())->create($responseException);
    }
}
