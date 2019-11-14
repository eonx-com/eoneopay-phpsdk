<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait TransactionTrait
{
    /**
     * Transaction action.
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $action;

    /**
     * Transaction allocation.
     *
     * @Groups({"create", "get", "update"})
     *
     * @Assert\NotBlank()
     * @Assert\Valid()
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Transactions\Allocation
     */
    protected $allocation;

    /**
     * Transaction amount.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="\EoneoPay\PhpSdk\Endpoints\Amount")
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Amount|null
     */
    protected $amount;

    /**
     * Approved.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="bool")
     *
     * @var bool|null
     */
    protected $approved;

    /**
     * Created at date.
     *
     * @Groups({"get"})
     *
     * @Assert\DateTime(format="Y-m-d\TH:i:sP")
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * Transaction description.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $description;

    /**
     * If the transaction was finalised.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="bool")
     *
     * @var bool|null
     */
    protected $finalised;

    /**
     * When the transaction was finalised.
     *
     * @Groups({"get"})
     *
     * @Assert\DateTime(format="Y-m-d\TH:i:sP")
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $finalisedAt;

    /**
     * Original funding source for allocation transaction.
     *
     * @Groups({"create", "get"})
     *
     * @Assert\Type(type="\EoneoPay\PhpSdk\Endpoints\PaymentSource")
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $fundingSource;

    /**
     * Order id.
     *
     * @Assert\Type(type="string")
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $id;

    /**
     * Transaction metadata.
     *
     * @Assert\Type(type="array")
     *
     * @Groups({"get"})
     *
     * @var mixed[]|null
     */
    protected $metadata;

    /**
     * Parent transaction.
     *
     * @Assert\Type(type="\EoneoPay\PhpSdk\Endpoints\Transaction")
     *
     * @Groups({"get"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Transaction|null
     */
    protected $parent;

    /**
     * Payment destination.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="\EoneoPay\PhpSdk\Endpoints\PaymentSource")
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentDestination;

    /**
     * Payment source.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="\EoneoPay\PhpSdk\Endpoints\PaymentSource")
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentSource;

    /**
     * Recurring ID.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $recurring_id;

    /**
     * Transaction response.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="array")
     *
     * @var mixed[]
     */
    protected $response;

    /**
     * Transaction security.
     *
     * @Groups({"create", "get", "update"})
     *
     * @Assert\Type(type="\EoneoPay\PhpSdk\Endpoints\Security")
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Security|null
     */
    protected $security;

    /**
     * Original statement Transaction description.
     *
     * @Groups({"get"})
     *
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $statementDescription;

    /**
     * Transaction state.
     *
     * @Assert\NotBlank()
     * @Assert\Positive()
     * @Assert\Type(type="int")
     *
     * @var int|null
     */
    protected $state;

    /**
     * Transaction status.
     *
     * @Assert\Type(type="string")
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @deprecated Being removed in favour of $state.
     *
     * @var string|null
     */
    protected $status;

    /**
     * Transaction id.
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $transactionId;

    /**
     * Transaction updated at date.
     *
     * @Groups({"get"})
     *
     * @Assert\DateTime(format="Y-m-d\TH:i:sP")
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * User associated with this transaction.
     *
     * @Groups({"create", "get"})
     *
     * @Assert\Type(type="\EoneoPay\PhpSdk\Endpoints\User")
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;
}
