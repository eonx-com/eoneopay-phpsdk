<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Transactions;

use Symfony\Component\Serializer\Annotation\Groups;

trait AllocationTrait
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

    /**
     * Allocation records.
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Transactions\Allocations\Record[]|null
     */
    protected $records;
}
