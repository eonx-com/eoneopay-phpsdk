<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Traits\PaymentSources\BankAccountTrait;

/**
 * @method string|null getCountry()
 * @method string|null getCurrency()
 * @method string|null getNumber()
 * @method string|null getPrefix()
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
 */
class BankAccount extends PaymentSource
{
    use BankAccountTrait;

    /**
     * Bank account constructor.
     *
     * @param mixed[]|null $data
     * @param bool|null $isOneTime
     */
    public function __construct(?array $data = null, ?bool $isOneTime = null)
    {
        parent::__construct($data, $isOneTime);

        $this->type = self::SOURCE_BANK_ACCOUNT;
    }
}
