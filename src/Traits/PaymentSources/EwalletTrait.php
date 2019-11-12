<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\PaymentSources;

use Symfony\Component\Serializer\Annotation\Groups;

trait EwalletTrait
{
    /**
     * Ewallet currency.
     *
     * @Groups({"create", "get"})
     *
     * @var string|null
     */
    protected $currency;

    /**
     * If is primary.
     *
     * @Groups({"create", "update", "get"})
     *
     * @var bool
     */
    protected $primary;

    /**
     * Ewallet user reference.
     *
     * @Groups({"create", "get"})
     *
     * @var string|null
     */
    protected $reference;

    /**
     * Ewallet user.
     *
     * @Groups({"create", "get"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;
}
