<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users;

use Symfony\Component\Serializer\Annotation\Groups;

trait ContractTrait
{
    /**
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $action;

    /**
     * @var string|null
     */
    protected $createdAt;

    /**
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $currency;

    /**
     * @var \EoneoPay\PhpSdk\Endpoints\Ewallet|null
     */
    protected $ewallet;

    /**
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $fixedFee;

    /**
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $group;

    /**
     * @var string|null
     */
    protected $updatedAt;

    /**
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;

    /**
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $variableRate;
}
