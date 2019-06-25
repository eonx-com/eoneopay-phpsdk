<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Factories;

use EoneoPay\PhpSdk\Exceptions\ClientException;
use EoneoPay\PhpSdk\Exceptions\CriticalException;
use EoneoPay\PhpSdk\Exceptions\RuntimeException;
use EoneoPay\PhpSdk\Exceptions\ValidationException;
use EoneoPay\PhpSdk\Factories\ExceptionFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Response;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Factories\ExceptionFactory
 */
class ExceptionFactoryTest extends TestCase
{
    /**
     * Returns data for testCreate
     *
     * @return mixed[]
     */
    public function getCreateData(): iterable
    {
        $responseException = new InvalidApiResponseException(new Response(null, null, null, \json_encode([
            'code' => 1999,
            'message' => 'internal system error'
        ]) ?: null));

        yield 'critical exception' => [
            'responseException' => $responseException,
            'expectedExceptionClass' => CriticalException::class,
            'expectedExceptionMessage' => 'internal system error'
        ];

        $responseException = new InvalidApiResponseException(new Response(null, null, null, \json_encode([
            'code' => 6000,
            'message' => 'validation exception'
        ]) ?: null));

        yield 'validation exception' => [
            'responseException' => $responseException,
            'expectedExceptionClass' => ValidationException::class,
            'expectedExceptionMessage' => 'validation exception'
        ];

        $responseException = new InvalidApiResponseException(new Response(null, null, null, \json_encode([
            'code' => 5000,
            'message' => 'runtime exception'
        ]) ?: null));

        yield 'runtime exception' => [
            'responseException' => $responseException,
            'expectedExceptionClass' => RuntimeException::class,
            'expectedExceptionMessage' => 'runtime exception'
        ];

        $responseException = new InvalidApiResponseException(new Response(null, null, null, \json_encode([
            'code' => 4000,
            'message' => 'client exception'
        ]) ?: null));

        yield 'client exception' => [
            'responseException' => $responseException,
            'expectedExceptionClass' => ClientException::class,
            'expectedExceptionMessage' => 'client exception'
        ];
    }

    /**
     * Test create exceptions
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException $responseException
     * @param string $expectedClass
     * @param string $expectedMessage
     *
     * @return void
     *
     * @dataProvider getCreateData
     */
    public function testCreate(
        InvalidApiResponseException $responseException,
        string $expectedClass,
        string $expectedMessage
    ): void {
        $factory = new ExceptionFactory();
        $exception = $factory->create($responseException);

        /** @noinspection UnnecessaryAssertionInspection Variable exception classes returned */
        self::assertInstanceOf($expectedClass, $exception);
        self::assertSame($expectedMessage, $exception->getMessage());
        self::assertSame($responseException, $exception->getPrevious());
    }
}
