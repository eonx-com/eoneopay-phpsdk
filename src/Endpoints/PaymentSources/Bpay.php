<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Traits\PaymentSources\BpayTrait;

/**
 * @method string|null getBillerCode()
 * @method string|null getBillerName()
 * @method string|null getReferenceNumber()
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
 */
class Bpay extends PaymentSource
{
    use BpayTrait;

    /**
     * Bpay constructor.
     *
     * @param mixed[]|null $data
     * @param bool|null $isOneTime
     */
    public function __construct(?array $data = null, ?bool $isOneTime = null)
    {
        parent::__construct($data, $isOneTime);

        $this->type = self::SOURCE_BPAY;
    }
}
