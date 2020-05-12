<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Traits\PaymentSources\CreditCardTrait;

/**
 * @method mixed[]|null getBin()
 * @method string|null getCvc()
 * @method mixed[]|null getExpiry()
 * @method string|null getFacility()
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
 */
class CreditCard extends PaymentSource
{
    use CreditCardTrait;

    /**
     * Credit card constructor.
     *
     * @param mixed[]|null $data
     * @param bool|null $isOneTime
     */
    public function __construct(?array $data = null, ?bool $isOneTime = null)
    {
        parent::__construct($data, $isOneTime);

        $this->type = self::SOURCE_CREDIT_CARD;
    }
}
