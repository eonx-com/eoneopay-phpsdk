<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\SchedulePayments;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Traits\SchedulePaymentTrait;

class RemoveRequest extends AbstractRequest
{
    use SchedulePaymentTrait;

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
            self::DELETE => \sprintf('/schedule/%s', $this->id)
        ];
    }
}
