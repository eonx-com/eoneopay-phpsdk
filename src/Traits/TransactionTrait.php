<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait TransactionTrait
{
    /**
     * Action.
     *
     * @Assert\NotBlank(groups={"create"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|mixed
     */
    protected $action;

    /**
     * Approved.
     *
     * @var null|bool
     */
    protected $approved;

    /**
     * Completed date.
     *
     * @var null|string
     */
    protected $completedAt;

    /**
     * Transaction id.
     *
     * @Assert\NotBlank(groups={"create", "delete", "update"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $id;

    /**
     * Remitter Name
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $name;

    /**
     * Original transaction id.
     *
     * @Assert\NotBlank(groups={"update"})
     *
     * @Groups({"delete", "update"})
     *
     * @var null|string
     */
    protected $originalId;

    /**
     * Secondary Id.
     *
     * @Assert\NotBlank(groups={"create", "delete", "update"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $secondaryId;

    /**
     * Security Id.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $securityId;

    /**
     * Statement Description.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $statementDescription;

    /**
     * Transaction status.
     *
     * @var null|string
     */
    protected $status;
}
