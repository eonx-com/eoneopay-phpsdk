<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Traits\PaymentSources\BpayTrait;

/**
 * @method Ewallet|null getAllocationEwallet()
 * @method string|null getBillerCode()
 * @method string|null getBillerName()
 * @method Ewallet getEwallet()
 * @method string|null getReferenceNumber()
 * @method User|null getUser()
 */
class Bpay extends PaymentSource
{
    use BpayTrait;

    /**
     * Allocation ewallet associated with this Bpay.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet|null
     */
    protected $allocationEwallet;

    /**
     * Ewallet associated with this Bpay.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet
     */
    protected $ewallet;

    /**
     * User associated with this Bpay.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User
     */
    protected $user;

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
