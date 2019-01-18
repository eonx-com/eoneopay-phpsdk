<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\ScheduledPayments\BankAccount;

use EoneoPay\PhpSdk\Requests\ScheduledPayments\ScheduledPaymentRequest;
use EoneoPay\PhpSdk\Responses\ScheduledPayments\BankAccount;

class GetRequest extends ScheduledPaymentRequest
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
