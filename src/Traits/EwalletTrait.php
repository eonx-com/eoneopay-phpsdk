<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait EwalletTrait
{
    /**
     * Ewallet balance.
     *
     * @var mixed[]|null
     */
    protected $balances;

    /**
     * Created at date.
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * Ewallet currency.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $currency;

    /**
     * Ewallet id.
     *
     * @var string|null
     */
    protected $id;

    /**
     * Ewallet pan.
     *
     * @var string|null
     */
    protected $pan;

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
     * Ewallet type.
     *
     * @var string|null
     */
    protected $type;

    /**
     * Updated at date.
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * Ewallet user.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;
}
