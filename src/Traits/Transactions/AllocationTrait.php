<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Transactions;

use Symfony\Component\Validator\Constraints as Assert;

trait AllocationTrait
{
    /**
     * Allocation amount.
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
     * @Assert\NotBlank()
     * @Assert\Type(type="object")
     * @Assert\Valid()
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Ewallet|null
     */
    protected $ewallet;

    /**
     * Allocation records.
     *
     * @Assert\All({})
     * @Assert\Type(type="array")
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Transactions\Allocations\Record[]|null
     */
    protected $records;
}
