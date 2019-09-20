<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\PaymentSources;

trait BpayTrait
{
    /**
     * Bpay biller code.
     *
     * @var string|null
     */
    protected $billerCode;

    /**
     * Bpay biller name
     *
     * @var string|null
     */
    protected $billerName;

    /**
     * Bpay reference number
     *
     * @var string|null
     */
    protected $referenceNumber;
}
