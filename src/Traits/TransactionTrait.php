<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait TransactionTrait
{
    /**
     * Amount.
     *
     * @Assert\NotBlank(groups={"create", "delete", "update"})
     * @Assert\Type(type="string", groups={"create", "delete", "update"})
     * @Assert\Type(type="numeric", groups={"create", "delete", "update"})
     * @Assert\GreaterThan(value="0", groups={"create", "delete", "update"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $amount;

    /**
     * Currency.
     *
     * @Assert\Currency(groups={"create", "delete", "update"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $currency;

    /**
     * @Assert\NotBlank(groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $id;

    /**
     * @Assert\NotNull(groups={"create", "delete", "get", "update"})
     * @Assert\Valid(groups={"create", "delete", "get", "update"})
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\Gateway
     */
    protected $gateway;

    /**
     * @Assert\NotBlank(groups={"update"})
     *
     * @Groups({"update"})
     *
     * @var null|string
     */
    protected $originalId;

    /**
     * Reference.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $reference;

    /**
     * Remitter Name
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $remitterName;

    /**
     * @var null|string
     */
    protected $recurringId;

    /**
     * Request id.
     *
     * @var null|string
     */
    protected $requestId;

    /**
     * Statement Description.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $statementDescription;

    /**
     * Security Id.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $securityId;

    /**
     * @var null|string
     */
    protected $settledAt;

    /**
     * @var null|int
     */
    protected $status;
}
