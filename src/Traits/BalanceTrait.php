<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait BalanceTrait
{
    /**
     * The usable money on this Ewallet.
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $available;

    /**
     * Current balance of this Ewallet.
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $balance;

    /**
     * The credit limit on this Ewallet.
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $creditLimit;
}
