<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Traits\PaymentSources\EwalletTrait;

/**
 * @method string|null getCurrency()
 * @method bool|null getPrimary()
 * @method string|null getReference()
 * @method User|null getUser()
 */
class Ewallet extends PaymentSource
{
    use EwalletTrait;

    /**
     * Ewallet constructor.
     *
     * @param mixed[]|null $data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        $this->type = self::SOURCE_EWALLET;
    }
}
