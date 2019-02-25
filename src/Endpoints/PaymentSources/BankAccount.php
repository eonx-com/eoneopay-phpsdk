<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;

class BankAccount extends PaymentSource
{
    public function __construct($data = null)
    {
        parent::__construct($data);

        $this->type = 'bank_account';
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return \array_merge(parent::uris(), []);
    }
}
