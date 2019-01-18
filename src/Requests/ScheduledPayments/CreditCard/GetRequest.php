<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\ScheduledPayments\CreditCard;

use EoneoPay\PhpSdk\Requests\ScheduledPayments\ScheduledPaymentRequest;
use EoneoPay\PhpSdk\Responses\ScheduledPayments\CreditCard;

class GetRequest extends ScheduledPaymentRequest
{
    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return CreditCard::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::GET => \sprintf('/schedules/%s', $this->id),
            self::LIST => '/schedules'
        ];
    }
}
