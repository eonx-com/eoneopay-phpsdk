<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait TransactionTrait
{
    /**
     * Transaction action.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var string|null
     */
    protected $action;

    /**
     * Transaction allocation.
     *
     * @Groups({"create", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Transactions\Allocation|null
     */
    protected $allocation;

    /**
     * Transaction amount.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Amount|null
     */
    protected $amount;

    /**
     * Approved.
     *
     * @var bool|null
     */
    protected $approved;

    /**
     * Created at date.
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * When the transaction was finalised.
     *
     * @var string|null
     */
    protected $finalisedAt;

    /**
     * Original funding source for allocation transaction.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $fundingSource;

    /**
     * Order id.
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @var string|null
     */
    protected $id;

    /**
     * Transaction metadata.
     *
     * @Groups({"create", "delete", "update"})
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
     * @Groups({"create", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentDestination;

    /**
     * Payment source.
     *
     * @Groups({"create", "update"})
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
     * @Groups({"create", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Security|null
     */
    protected $security;

    /**
     * Transaction status.
     *
     * @var string|null
     */
    protected $status;

    /**
     * Transaction id.
     *
     * @Groups({"create", "delete", "get", "update"})
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
     * @var \EoneoPay\PhpSdk\Endpoints\User
     */
    protected $user;
}
