<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Requests\Payloads;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait AmountTrait
{
    /**
     * Currency.
     *
     * @Assert\NotBlank(groups={"create", "delete", "pay", "update"})
     * @Assert\Currency(groups={"create", "delete", "pay", "update"})
     *
     * @Groups({"create", "delete", "pay", "update"})
     *
     * @var null|string
     */
    protected $currency;

    /**
     * @Groups({"create", "delete", "pay", "update"})
     *
     * @var null|string
     */
    protected $paymentFee;

    /**
     * Sub-total amount.
     *
     * @Assert\Expression(
     *     "this.subtotal or this.total",
     *     groups={"amount_validate"},
     *     message="field is required when total is not present."
     * )
     * @Assert\Type(type="numeric", groups={"create", "delete", "pay", "update"})
     *
     * @Groups({"create", "delete", "update", "pay", "amount_validate"})
     *
     * @var null|string
     */
    protected $subtotal;

    /**
     * Total amount.
     *
     * @Assert\Expression(
     *     "this.total or this.subtotal",
     *     groups={"amount_validate"},
     *     message="field is required when subtoal is not present."
     * )
     * @Assert\Type(type="numeric", groups={"create", "delete", "pay", "update"})
     *
     * @Groups({"create", "delete", "update", "pay", "amount_validate"})
     *
     * @var null|string
     */
    protected $total;
}
