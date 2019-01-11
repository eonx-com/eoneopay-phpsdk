<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\SchedulePayments;

use EoneoPay\PhpSdk\Requests\SchedulePayments\SchedulePaymentRequest;

class SchedulePaymentRequestStub extends SchedulePaymentRequest
{
    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/schedules/test-id'
        ];
    }
}
