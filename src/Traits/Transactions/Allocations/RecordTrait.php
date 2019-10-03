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
     * @Assert\Type(type="string")
     * @Assert\Valid()
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $amount;

    /**
     * Allocation ewallet.
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="object")
     * @Assert\Valid()
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Ewallet|null
     */
    protected $ewallet;
}
