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
     * @Assert\NotBlank(groups={"create_txn"})
     * @Assert\Type(type="string", groups={"create_txn"})
     * @Assert\Type(type="numeric", groups={"create_txn"})
     * @Assert\GreaterThan(value="0", groups={"create_txn"})
     *
     * @Groups({"create_txn"})
     *
     * @var null|string
     */
    protected $amount;

    /**
     * Ewallet token.
     *
     * @Assert\NotBlank(groups={"create_crn", "create_schedule", "create_txn"})
     * @Assert\Type(type="string", groups={"create_crn", "create_schedule", "create_txn"})
     *
     * @Groups({"create_crn", "create_schedule", "create_txn"})
     *
     * @var null|string
     */
    protected $ewallet;

    /**
     * Percentage.
     *
     * @Assert\NotBlank(groups={"create_crn", "create_schedule"})
     * @Assert\Type(type="string", groups={"create_crn", "create_schedule"})
     * @Assert\Type(type="numeric", groups={"create_crn", "create_schedule"})
     * @Assert\GreaterThan(value="0", groups={"create_crn", "create_schedule"})
     *
     * @Groups({"create_crn", "create_schedule"})
     *
     * @var null|string
     */
    protected $percentage;
}
