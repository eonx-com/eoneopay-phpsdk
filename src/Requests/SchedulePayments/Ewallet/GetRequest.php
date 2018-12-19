<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\SchedulePayments\Ewallet;

use EoneoPay\PhpSdk\Requests\SchedulePayments\SchedulePaymentRequest;
use EoneoPay\PhpSdk\Responses\SchedulePayments\Ewallet;

class GetRequest extends SchedulePaymentRequest
{
    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return Ewallet::class;
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
