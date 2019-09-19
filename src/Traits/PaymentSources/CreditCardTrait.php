<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\PaymentSources;

use Symfony\Component\Serializer\Annotation\Groups;

trait CreditCardTrait
{
    /**
     * Credit card bin.
     *
     * @Groups({"create"})
     *
     * @var mixed[]|null
     */
    protected $bin;

    /**
     * Expiry month and year.
     *
     * @Groups({"create"})
     *
     * @var mixed[]|null
     */
    protected $expiry;

    /**
     * Credit card facility.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $facility;
}
