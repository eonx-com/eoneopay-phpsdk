<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Transactions;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait AllocationTrait
{
    /**
     * Allocation amount.
     *
     * @Groups({"create"})
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $amount;

    /**
     * Allocation ewallet.
     *
     * @Groups({"create"})
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="object")
     * @Assert\Valid
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Ewallet|null
     */
    protected $ewallet;

    /**
     * Allocation records.
     *
     * @Groups({"create"})
     *
     * @Assert\All({})
     * @Assert\Type(type="array")
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Transactions\Allocations\Record[]|null
     */
    protected $records;
}
