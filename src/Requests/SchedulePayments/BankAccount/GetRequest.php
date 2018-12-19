<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\SchedulePayments\BankAccount;

use EoneoPay\PhpSdk\Requests\SchedulePayments\SchedulePaymentRequest;
use EoneoPay\PhpSdk\Responses\SchedulePayments\BankAccount;

class GetRequest extends SchedulePaymentRequest
{
    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return BankAccount::class;
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
