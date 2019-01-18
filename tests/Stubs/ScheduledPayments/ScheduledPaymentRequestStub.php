<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\ScheduledPayments;

use EoneoPay\PhpSdk\Requests\ScheduledPayments\ScheduledPaymentRequest;

class ScheduledPaymentRequestStub extends ScheduledPaymentRequest
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
