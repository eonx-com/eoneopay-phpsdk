<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Services\Webhooks\Exceptions;

use EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
 */
final class InvalidEntityClassExceptionTest extends TestCase
{
    /**
     * Test get error code.
     *
     * @return void
     */
    public function testGetErrorCode(): void
    {
        $exception = new InvalidEntityClassException('test');

        self::assertSame(1100, $exception->getErrorCode());
    }

    /**
     * Test get error sub code.
     *
     * @return void
     */
    public function testGetErrorSubCode(): void
    {
        $exception = new InvalidEntityClassException('test');

        self::assertSame(1, $exception->getErrorSubCode());
    }
}
