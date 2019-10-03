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
     * @var mixed[]|null
     *
     * @Assert\Type(type="string")
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
     *
     * @Assert\Type(type="string")
     */
    protected $currency;

    /**
     * Ewallet id.
     *
     * @var string|null
     *
     * @Assert\Type(type="string")
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
     * @var string|null
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    protected $reference;

    /**
     * Ewallet type.
     *
     * @var string|null
     *
     * @Assert\Type(type="string")
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
