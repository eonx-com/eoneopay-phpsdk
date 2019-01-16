<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\AllocationTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class Allocation extends BaseDataTransferObject
{
    use AllocationTrait;

    /**
     * @Assert\Count(
     *     groups={"create_crn", "create_schedule", "create_txn"},
     *     min = 1,
     *     minMessage = "You must provide at least one record.",
     * )
     * @Assert\Valid(groups={"create_crn", "create_schedule", "create_txn"})
     *
     * @Groups({"create_crn", "create_schedule", "create_txn"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\Allocations\Record[]
     */
    protected $records;
}
