<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\ScheduledPayments;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\Utils\DateTime;
use EoneoPay\Utils\Exceptions\BaseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\Stubs\ScheduledPayments\ScheduledPaymentRequestStub;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\ScheduledPaymentRequest
 */
class SchedulePaymenRequestTest extends RequestTestCase
{
    /**
     * Test schedule payment frequency format validation.
     *
     * @return void
     */
    public function testFrequencyFormatValidation(): void
    {
        try {
            $this->createClient()->create(new ScheduledPaymentRequestStub([
                'amount' => new Amount([
                    'currency' => 'AUD',
                    'total' => '100.00'
                ]),
                'id' => $this->generateId(),
                'start_date' => new DateTime(),
                'frequency' => 'INVALID'
            ]));
        } catch (BaseException $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'frequency' => ['This value is not valid.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Test schedule payment validation.
     *
     * @return void
     */
    public function testValidation(): void
    {
        try {
            $this->createClient()->create(new ScheduledPaymentRequestStub());
        } catch (BaseException $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'amount' => ['This value should not be null.'],
                    'frequency' => ['This value should not be blank.'],
                    'id' => ['This value should not be blank.'],
                    'start_date' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }
}
