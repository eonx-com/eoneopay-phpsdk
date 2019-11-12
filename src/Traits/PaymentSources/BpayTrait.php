<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\PaymentSources;

use Symfony\Component\Serializer\Annotation\Groups;

trait BpayTrait
{
    /**
     * Bpay biller code.
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $billerCode;

    /**
     * Bpay biller name.
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $billerName;

    /**
     * Bpay reference number.
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $referenceNumber;
}
