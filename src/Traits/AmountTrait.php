<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait AmountTrait
{
    /**
     * Currency to use for amount.
     *
     * @Groups({"create", "delete", "update"})
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
     *
     * @var string|null
     */
    protected $subtotal;

    /**
     * The amount to charge.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var string|null
     */
    protected $total;
}
