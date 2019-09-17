<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\PaymentSources;

use Symfony\Component\Serializer\Annotation\Groups;

trait BankAccountTrait
{
    /**
     * Bank account country.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $country;

    /**
     * Bank account currency.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $currency;

    /**
     * Bank account number.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $number;

    /**
     * Bank account prefix.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $prefix;
}
