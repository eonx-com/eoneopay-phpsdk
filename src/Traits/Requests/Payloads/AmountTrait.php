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
     * @Assert\Currency(groups={"create", "delete", "update"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $currency;

    /**
     * Sub-total amount.
     *
     * @Assert\Type(type="string", groups={"create", "delete", "update"})
     * @Assert\Type(type="numeric", groups={"create", "delete", "update"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $subTotal;

    /**
     * Total amount.
     *
     * @Assert\NotBlank(groups={"create", "delete", "update"})
     * @Assert\Type(type="string", groups={"create", "delete", "update"})
     * @Assert\Type(type="numeric", groups={"create", "delete", "update"})
     * @Assert\GreaterThan(value="0", groups={"create", "delete", "update"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $total;
}
