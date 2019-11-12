<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users;

use Symfony\Component\Serializer\Annotation\Groups;

trait ContractTrait
{
    /**
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $currency;

    /**
     * @Groups({"create", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Ewallet|null
     */
    protected $ewallet;

    /**
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $fixedFee;

    /**
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $group;

    /**
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $type;

    /**
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * @Groups({"get"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;

    /**
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $variableRate;
}
