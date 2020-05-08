<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Factories;

use EoneoPay\PhpSdk\Exceptions\ClientException;
use EoneoPay\PhpSdk\Exceptions\CriticalException;
use EoneoPay\PhpSdk\Exceptions\RuntimeException;
use EoneoPay\PhpSdk\Exceptions\ValidationException;
use EoneoPay\PhpSdk\Factories\ExceptionFactory;
use EoneoPay\Utils\Interfaces\Exceptions\ExceptionInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Response;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Factories\ExceptionFactory
 */
final class ExceptionFactoryTest extends TestCase
{
    /**
     * Returns data for testCreate.
     *
     * @return mixed[]
     */
    public function getCreateData(): iterable
    {
        $responseException = new InvalidApiResponseException(new Response(null, null, null, \json_encode([
            'code' => 1999,
            'message' => 'internal system error',
        ]) ?: null));

        yield 'critical exception' => [
            'responseException' => $responseException,
            'expectedException' => new CriticalException(
                'internal system error',
                null,
                1999,
                $responseException,
                0
            ),
        ];

        $responseException = new InvalidApiResponseException(new Response(null, null, null, \json_encode([
            'code' => 1999,
            'sub_code' => 2,
            'message' => 'internal system error',
        ]) ?: null));

        yield 'critical exception with sub code' => [
            'responseException' => $responseException,
            'expectedException' => new CriticalException(
                'internal system error',
                null,
                1999,
                $responseException,
                2
            ),
        ];

        $responseException = new InvalidApiResponseException(new Response(null, null, null, \json_encode([
            'code' => 6000,
            'sub_code' => 1,
            'message' => 'validation exception',
        ]) ?: null));

        yield 'validation exception' => [
            'responseException' => $responseException,
            'expectedException' => new ValidationException(
                'validation exception',
                null,
                6000,
                $responseException,
                null,
                1
            ),
        ];

        $responseException = new InvalidApiResponseException(new Response(null, null, null, \json_encode([
            'code' => 5000,
            'sub_code' => 3,
            'message' => 'runtime exception',
        ]) ?: null));

        yield 'runtime exception' => [
            'responseException' => $responseException,
            'expectedException' => new RuntimeException(
                'runtime exception',
                null,
                5000,
                $responseException,
                3
            ),
        ];

        $responseException = new InvalidApiResponseException(new Response(null, null, null, \json_encode([
            'code' => 4000,
            'sub_code' => 4,
            'message' => 'client exception',
        ]) ?: null));

        yield 'client exception' => [
            'responseException' => $responseException,
            'expectedException' => new ClientException(
                'client exception',
                null,
                4000,
                $responseException,
                4
            ),
        ];

        $responseException = new InvalidApiResponseException(new Response(null, null, null, \json_encode([
            'code' => 4000,
            'sub_code' => 4,
            'message' => ['message' => 'client exception'],
        ]) ?: null));

        yield 'client exception' => [
            'responseException' => $responseException,
            'expectedException' => new ClientException(
                'client exception',
                null,
                4000,
                $responseException,
                4
            ),
        ];

        $responseException = new InvalidApiResponseException(new Response(null, null, null, \json_encode([
            'code' => 4000,
            'sub_code' => 4,
            'message' => ['not_message' => ['error' => ['message' => 'client exception']]],
        ]) ?: null));

        yield 'client exception' => [
            'responseException' => $responseException,
            'expectedException' => new ClientException(
                'client exception',
                null,
                4000,
                $responseException,
                4
            ),
        ];

        $rawContent = \json_encode(['code' => 4000, 'sub_code' => 4]);
        $responseException = new InvalidApiResponseException(new Response(null, null, null, $rawContent ?: null));

        yield 'client exception' => [
            'responseException' => $responseException,
            'expectedException' => new ClientException(
                \sprintf('Could not resolve message for raw content: "%s"', $rawContent),
                null,
                4000,
                $responseException,
                4
            ),
        ];
    }

    /**
     * Test create exceptions.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException $responseException
     * @param \EoneoPay\Utils\Interfaces\Exceptions\ExceptionInterface $expectedException
     *
     * @return void
     *
     * @dataProvider getCreateData
     */
    public function testCreate(
        InvalidApiResponseException $responseException,
        ExceptionInterface $expectedException
    ): void {
        $factory = new ExceptionFactory();
        $exception = $factory->create($responseException);

        self::assertEquals($expectedException, $exception);
    }
}
