<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;

class CreditCard extends PaymentSource
{
    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return \array_merge(parent::uris(), []);
    }
}
