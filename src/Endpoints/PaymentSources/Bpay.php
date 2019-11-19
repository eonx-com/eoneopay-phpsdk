<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Traits\PaymentSources\BpayTrait;

/**
 * @method string|null getBillerCode()
 * @method string|null getBillerName()
 * @method string|null getReferenceNumber()
 */
class Bpay extends PaymentSource
{
    use BpayTrait;

    /**
     * Bpay constructor.
     *
     * @param mixed[]|null $data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        $this->type = self::SOURCE_BPAY;
    }
}
