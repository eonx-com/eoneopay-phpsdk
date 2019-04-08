<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait TransactionTrait
{
    /**
     * Transaction action.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $action;

    /**
     * Transaction allocation.
     *
     * @var mixed[]|null
     */
    protected $allocation;

    /**
     * Transaction amount.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var mixed[]|null
     */
    protected $amount;

    /**
     * Approved.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var bool
     */
    protected $approved;

    /**
     * Created at date.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * Original funding source for allocation transaction.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $fundingSource;

    /**
     * Order id.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $id;

    /**
     * Transaction metadata.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var mixed[]|null
     */
    protected $metadata;

    /**
     * Parent transaction.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Transaction|null
     */
    protected $parent;

    /**
     * Payment destination.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentDestination;

    /**
     * Payment source.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentSource;

    /**
     * Transaction response.
     *
     * @var mixed[]
     */
    protected $response;

    /**
     * Transaction security.
     *
     * @var mixed
     */
    protected $security;

    /**
     * Transaction statement description.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $statementDescription;

    /**
     * Transaction status.
     *
     * @var string|null
     */
    protected $status;

    /**
     * Transaction id.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $transactionId;

    /**
     * Transaction updated at date.
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * User associated with this transaction.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User
     */
    protected $user;
}
