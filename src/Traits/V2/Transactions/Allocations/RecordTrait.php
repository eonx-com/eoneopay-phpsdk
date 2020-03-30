<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\V2\Transactions\Allocations;

use Symfony\Component\Validator\Constraints as Assert;

trait RecordTrait
{
    /**
     * Allocation amount.
     *
     * @Assert\Type(type="string")
     * @Assert\Valid()
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
     * @var \EoneoPay\PhpSdk\Endpoints\V2\Ewallet|null
     */
    protected $ewallet;
}
