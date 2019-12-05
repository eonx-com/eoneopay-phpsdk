<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait AmountTrait
{
    /**
     * Currency to use for amount.
     * Serialization group 'create' required for FeeRepository compatibility
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $currency;

    /**
     * The calculated fee amount.
     *
     * @var string|null
     */
    protected $paymentFee;

    /**
     * The subtotal after fees.
     * Serialization group 'create' required for FeeRepository compatibility
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $subtotal;

    /**
     * The amount to charge.
     * Serialization group 'create' required for FeeRepository compatibility
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $total;
}
