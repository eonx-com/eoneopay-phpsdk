<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\ScheduledPayments\Ewallet;

use EoneoPay\PhpSdk\Requests\ScheduledPayments\AbstractPayRequest;
use EoneoPay\PhpSdk\Responses\Transactions\Ewallet;

class PayRequest extends AbstractPayRequest
{
    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return Ewallet::class;
    }
}
