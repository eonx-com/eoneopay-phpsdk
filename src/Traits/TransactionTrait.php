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
     * Transaction amount.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var mixed[]|null
     */
    protected $amount;

    /**
     * Order id.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $id;

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
     * Transaction statement description.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $statementDescription;

    /**
     * Transaction id.
     *
     * @Groups({"create", "delete", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $transactionId;

    /**
     * User associated with this transaction.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User
     */
    protected $user;
}
