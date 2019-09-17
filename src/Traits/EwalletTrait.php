<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait EwalletTrait
{
    /**
     * Ewallet balance.
     *
     * @Groups({"get", "list", "update"})
     *
     * @var mixed[]|null
     */
    protected $balances;

    /**
     * Created at date.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * Ewallet currency.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $currency;

    /**
     * Ewallet id.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $id;

    /**
     * Ewallet pan.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $pan;

    /**
     * If is primary.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var bool
     */
    protected $primary;

    /**
     * Ewallet user reference.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $reference;

    /**
     * Ewallet type.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $type;

    /**
     * Updated at date.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * Ewallet user.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;
}
