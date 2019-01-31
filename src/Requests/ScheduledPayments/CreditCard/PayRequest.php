<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\ScheduledPayments\CreditCard;

use EoneoPay\PhpSdk\Requests\ScheduledPayments\AbstractPayRequest;
use EoneoPay\PhpSdk\Responses\Transactions\CreditCard;

class PayRequest extends AbstractPayRequest
{
    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return CreditCard::class;
    }
}
