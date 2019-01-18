<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait ScheduledPaymentTrait
{
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
     * @Assert\Regex("/^(-?)P(?=\d|T\d)(?:(\d+)Y)?(?:(\d+)M)?(?:(\d+)([DW]))?$/", groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $frequency;

    /**
     * Payment id
     *
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
