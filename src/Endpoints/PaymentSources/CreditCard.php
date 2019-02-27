<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Traits\PaymentSources\CreditCardTrait;

/**
 * @method mixed[]|null getBin()
 * @method mixed[]|null getExpiry()
 * @method string|null getFacility()
 */
class CreditCard extends PaymentSource
{
    use CreditCardTrait;
    /**
     * Credit card constructor.
     *
     * @param mixed[]|null $data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        $this->type = self::SOURCE_CREDIT_CARD;
    }
}
