<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\V2\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\V2\PaymentSource;
use EoneoPay\PhpSdk\Endpoints\V2\User;
use EoneoPay\PhpSdk\Traits\V2\PaymentSources\EwalletTrait;

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
