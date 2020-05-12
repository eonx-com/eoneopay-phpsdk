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
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
 */
class Ewallet extends PaymentSource
{
    use EwalletTrait;

    /**
     * Ewallet constructor.
     *
     * @param mixed[]|null $data
     * @param bool|null $isOneTime
     */
    public function __construct(?array $data = null, ?bool $isOneTime = null)
    {
        parent::__construct($data, $isOneTime);

        $this->type = self::SOURCE_EWALLET;
    }
}
