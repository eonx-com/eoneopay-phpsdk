<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\V2\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\V2\PaymentSource;
use EoneoPay\PhpSdk\Traits\PaymentSources\BankAccountTrait;

/**
 * @method string|null getCountry()
 * @method string|null getCurrency()
 * @method string|null getNumber()
 * @method string|null getPrefix()
 */
class BankAccount extends PaymentSource
{
    use BankAccountTrait;
    
    /**
     * BankAccount constructor.
     *
     * @param mixed[]|null $data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        $this->type = self::SOURCE_BANK_ACCOUNT;
    }
}
