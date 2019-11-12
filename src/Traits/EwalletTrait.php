<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait EwalletTrait
{
    /**
     * Ewallet balance.
     *
     * @Assert\Type(type="object")
     * @Assert\Valid()
     *
     * @Groups({"get"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Balance|null
     */
    protected $balances;

    /**
     * Created at date.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * Ewallet currency.
     *
     * @Assert\Type(type="string")
     *
     * @Groups({"create", "get"})
     *
     * @var string|null
     */
    protected $currency;

    /**
     * Ewallet id.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $id;

    /**
     * Ewallet pan.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $pan;

    /**
     * If is primary.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="bool")
     *
     * @var bool|null
     */
    protected $primary;

    /**
     * Ewallet user reference.
     *
     * @Groups({"create", "get", "update"})
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $reference;

    /**
     * Ewallet type.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $type;

    /**
     * Updated at date.
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * Ewallet user.
     *
     * @Groups({"get"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;
}
