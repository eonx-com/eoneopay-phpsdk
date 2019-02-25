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
     * Bank account constructor.
     *
     * @param mixed|null $data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        $this->type = self::SOURCE_BANK_ACCOUNT;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return \array_merge(parent::uris(), []);
    }
}
