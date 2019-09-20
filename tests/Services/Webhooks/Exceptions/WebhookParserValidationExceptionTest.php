<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Services\Webhooks\Exceptions;

use EoneoPay\PhpSdk\Services\Webhooks\Exceptions\WebhookParserValidationException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\WebhookParserValidationException
 */
class WebhookParserValidationExceptionTest extends TestCase
{
    /**
     * Tests the exception codes for the exception.
     *
     * @return void
     */
    public function testErrorCodes(): void
    {
        $violations = new ConstraintViolationList([
            new ConstraintViolation('Test violation.', null, [], 'root', null, 'test'),
        ]);
        $exception = new WebhookParserValidationException($violations);

        self::assertSame(1200, $exception->getCode());
        self::assertSame(1, $exception->getErrorSubCode());
        self::assertSame($violations, $exception->getViolations());
    }
}
