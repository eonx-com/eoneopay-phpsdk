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
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $paymentFee;

    /**
     * The subtotal after fees.
     *
     * @Groups({"get"})
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
