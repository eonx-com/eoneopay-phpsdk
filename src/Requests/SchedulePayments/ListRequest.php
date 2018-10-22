<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\SchedulePayments;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\SchedulePayment;
use EoneoPay\PhpSdk\Traits\SchedulePaymentTrait;

class ListRequest extends AbstractRequest
{
    use SchedulePaymentTrait;

    /**
     * @inheritdoc
     */
    public function expectObject(): string
    {
        return SchedulePayment::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::LIST => '/schedule'
        ];
    }
}
