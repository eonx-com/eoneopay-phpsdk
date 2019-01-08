<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait AllocationTrait
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
     * Ewallet token.
     *
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $ewallet;

    /**
     * Percentage.
     *
     * @Assert\NotBlank(groups={"create_schedule"})
     * @Assert\Type(type="string", groups={"create_schedule"})
     * @Assert\Type(type="numeric", groups={"create_schedule"})
     * @Assert\GreaterThan(value="0", groups={"create_schedule"})
     *
     * @Groups({"create_schedule"})
     *
     * @var null|string
     */
    protected $percentage;
}
