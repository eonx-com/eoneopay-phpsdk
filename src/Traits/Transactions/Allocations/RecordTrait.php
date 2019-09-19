<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Transactions\Allocations;

use Symfony\Component\Serializer\Annotation\Groups;

trait RecordTrait
{
    /**
     * Allocation amount.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $amount;

    /**
     * Allocaiton ewallet.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $ewallet;
}
