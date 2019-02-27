<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\PaymentSources;

use Symfony\Component\Serializer\Annotation\Groups;

trait EwalletTrait
{
    /**
     * Ewallet currency
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $currency;

    /**
     * If is primary
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var bool
     */
    protected $primary;

    /**
     * Ewallet user reference
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $reference;

    /**
     * Ewallet user
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;
}
