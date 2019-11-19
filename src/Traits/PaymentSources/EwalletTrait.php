<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\PaymentSources;

use Symfony\Component\Serializer\Annotation\Groups;

trait EwalletTrait
{
    /**
     * Ewallet currency.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $currency;

    /**
     * If is primary.
     *
     * @var bool
     */
    protected $primary;

    /**
     * Ewallet user reference.
     *
     * @var string|null
     */
    protected $reference;

    /**
     * Ewallet user.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;
}
