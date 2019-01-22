<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Exceptions;

use EoneoPay\PhpSdk\Exceptions\InvalidResponseContentType;
use Tests\EoneoPay\PhpSdk\TestCases\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Exceptions\InvalidResponseContentType
 */
class InvalidResponseContentTypeTest extends TestCase
{
    /**
     * Test codes are returned as expected
     *
     * @return void
     */
    public function testExceptionCodes(): void
    {
        $exception = new InvalidResponseContentType();

        self::assertSame(1120, $exception->getErrorCode());
        self::assertSame(1, $exception->getErrorSubCode());
    }
}
