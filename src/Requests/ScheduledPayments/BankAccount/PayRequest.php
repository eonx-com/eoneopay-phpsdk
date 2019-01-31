<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\ScheduledPayments\BankAccount;

use EoneoPay\PhpSdk\Requests\ScheduledPayments\AbstractPayRequest;
use EoneoPay\PhpSdk\Responses\Transactions\BankAccount;

class PayRequest extends AbstractPayRequest
{
    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return BankAccount::class;
    }
}
