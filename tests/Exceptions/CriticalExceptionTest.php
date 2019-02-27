<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Exceptions;

use EoneoPay\PhpSdk\Exceptions\CriticalException;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Exceptions\CriticalException
 */
class CriticalExceptionTest extends TestCase
{
    /**
     * Make sure error code is expected.
     *
     * @return void
     */
    public function testGetErrorCode(): void
    {
        $exception = new CriticalException(null, 1000);
        self::assertSame(1000, $exception->getErrorCode());
    }

    /**
     * Make sure error message is expected.
     *
     * @return void
     */
    public function testGetErrorMessage(): void
    {
        $exception = new CriticalException('error message');
        self::assertSame('error message', $exception->getErrorMessage());
    }

    /**
     * Make sure error sub code is expected.
     *
     * @return void
     */
    public function testGetErrorSubCode(): void
    {
        $exception = new CriticalException(null, 1000, null, 1);
        self::assertSame(1, $exception->getErrorSubCode());
    }
}
