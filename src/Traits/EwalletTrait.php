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
     * @var \EoneoPay\PhpSdk\Endpoints\Balance|null
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
     * @Assert\Type(type="string")
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $currency;

    /**
     * Ewallet id.
     *
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $id;

    /**
     * Ewallet pan.
     *
     * @var string|null
     *
     * @Assert\Type(type="string")
     */
    protected $pan;

    /**
     * If is primary.
     *
     * @var bool
     *
     * @Assert\Type(type="bool")
     */
    protected $primary;

    /**
     * Ewallet user reference.
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
     * @Assert\Type(type="string")
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
