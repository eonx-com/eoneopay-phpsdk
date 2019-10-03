<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Transactions\Allocations;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait RecordTrait
{
    /**
     * Allocation amount.
     *
     * @Groups({"create"})
     *
     * @Assert\Type(type="string")
     * @Assert\Valid
     *
     * @var string|null
     */
    protected $amount;

    /**
     * Allocaiton ewallet.
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
}
