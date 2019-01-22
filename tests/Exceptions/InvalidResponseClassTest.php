<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Exceptions;

use EoneoPay\PhpSdk\Exceptions\InvalidResponseClass;
use Tests\EoneoPay\PhpSdk\TestCases\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Exceptions\InvalidResponseClass
 */
class InvalidResponseClassTest extends TestCase
{
    /**
     * Test codes are returned as expected
     *
     * @return void
     */
    public function testExceptionCodes(): void
    {
        $exception = new InvalidResponseClass();

        self::assertSame(1110, $exception->getErrorCode());
        self::assertSame(1, $exception->getErrorSubCode());
    }
}
