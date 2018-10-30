<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\SchedulePayments;

class GetRequest extends SchedulePaymentRequest
{
    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::GET => \sprintf('/schedule/%s', $this->id),
            self::LIST => '/schedule'
        ];
    }
}
