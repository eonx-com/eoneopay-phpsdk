<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait SchedulePaymentTrait
{
    /**
     * Amount.
     *
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create"})
     * @Assert\Type(type="numeric", groups={"create"})
     * @Assert\GreaterThan(value="0", groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $amount;

    /**
     * Currency.
     *
     * @Assert\Currency(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $currency;

    /**
     * Schedule payment frequency.
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $endDate;

    /**
     * Frequency.
     *
     * @Assert\NotBlank(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $frequency;

    /**
     * @Assert\NotBlank(groups={"create", "delete", "get"})
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $id;

    /**
     * Start date.
     *
     * @Assert\NotBlank(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $startDate;
}
