<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\ScheduledPayments;

class RemoveRequest extends ScheduledPaymentRequest
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
            self::DELETE => \sprintf('/schedules/%s', $this->id)
        ];
    }
}
