<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Exceptions;

use EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException;
use EoneoPay\Utils\Interfaces\BaseExceptionInterface;
use Tests\EoneoPay\PhpSdk\TestCases\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException
 */
class ClientNotConfiguredExceptionTest extends TestCase
{
    /**
     * Test codes are returned as expected
     *
     * @return void
     */
    public function testExceptionCodes(): void
    {
        $exception = new ClientNotConfiguredException();

        self::assertSame(BaseExceptionInterface::DEFAULT_ERROR_CODE_RUNTIME, $exception->getErrorCode());
        self::assertSame(BaseExceptionInterface::DEFAULT_ERROR_SUB_CODE, $exception->getErrorSubCode());
    }
}
