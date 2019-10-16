<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

trait BalanceTrait
{
    /**
     * The usable money on this Ewallet.
     *
     * @var string|null
     */
    protected $available;

    /**
     * Current balance of this Ewallet.
     *
     * @var string|null
     */
    protected $balance;

    /**
     * The credit limit on this Ewallet.
     *
     * @var string|null
     */
    protected $creditLimit;
}
