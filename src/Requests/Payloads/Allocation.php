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
     * @Assert\NotNull(groups={"create"})
     * @Assert\Count(
     *     groups={"create"},
     *     min = 1,
     *     minMessage = "You must provide at least one record.",
     * )
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\Allocations\Record[]
     */
    protected $records;
}
