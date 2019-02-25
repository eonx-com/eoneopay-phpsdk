<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;

class CreditCard extends PaymentSource
{
    /**
     * Credit card constructor.
     *
     * @param mixed|null $data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        $this->type = 'credit_card';
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return \array_merge(parent::uris(), []);
    }
}
