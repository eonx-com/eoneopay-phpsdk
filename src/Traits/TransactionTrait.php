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
     * @Groups({"create", "delete", "update"})
     *
     * @Assert\NotBlank(message="A value was not provided.")
     * @Assert\Type(type="string", message="The type provided is invalid.")
     *
     * @var string|null
     */
    protected $action;

    /**
     * Transaction allocation.
     *
     * @Groups({"create", "update"})
     *
     * @Assert\NotBlank(message="A value was not provided.")
     * @Assert\Type(type="array", message="The type provided is invalid.")
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Transactions\Allocation|null
     */
    protected $allocation;

    /**
     * Transaction amount.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @Assert\NotBlank(message="A value was not provided.")
     * @Assert\Type(
     *     type="\EoneoPay\PhpSdk\Endpoints\Amount",
     *     message="The type provided is invalid."
     * )
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
     * @Assert\DateTime(format="Y-m-d\TH:i:sP")
     * @Assert\Type(type="string", message="The type provided is invalid.")
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * When the transaction was finalised.
     *
     * @Assert\DateTime(format="Y-m-d\TH:i:sP")
     * @Assert\Type(type="string", message="The type provided is invalid.")
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
     * @Assert\Type(type="string", message="The type provided is invalid.")
     *
     * @var string|null
     */
    protected $id;

    /**
     * Transaction metadata.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @Assert\Type(type="array", message="The type provided is invalid.")
     *
     * @var mixed[]|null
     */
    protected $metadata;

    /**
     * Parent transaction.
     *
     * @Assert\Type(
     *     type="\EoneoPay\PhpSdk\Endpoints\Transaction",
     *     message="The type provided is invalid."
     * )
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Transaction|null
     */
    protected $parent;

    /**
     * Payment destination.
     *
     * @Groups({"create", "update"})
     *
     * @Assert\Type(
     *     type="\EoneoPay\PhpSdk\Endpoints\PaymentSource",
     *     message="The type provided is invalid."
     * )
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentDestination;

    /**
     * Payment source.
     *
     * @Groups({"create", "update"})
     *
     * @Assert\Type(
     *     type="\EoneoPay\PhpSdk\Endpoints\PaymentSource",
     *     message="The type provided is invalid."
     * )
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentSource;

    /**
     * Transaction response.
     *
     * @Assert\Type(type="array", message="The type provided is invalid.")
     *
     * @var mixed[]
     */
    protected $response;

    /**
     * Transaction security.
     *
     * @Groups({"create", "update"})
     *
     * @Assert\Type(
     *     type="\EoneoPay\PhpSdk\Endpoints\Security",
     *     message="The type provided is invalid."
     * )
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Security|null
     */
    protected $security;

    /**
     * Transaction status.
     *
     * @Assert\Type(type="string", message="The type provided is invalid.")
     *
     * @var string|null
     */
    protected $status;

    /**
     * Transaction id.
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @Assert\Type(type="string", message="The type provided is invalid.")
     *
     * @var string|null
     */
    protected $transactionId;

    /**
     * Transaction updated at date.
     *
     * @Assert\DateTime(format="Y-m-d\TH:i:sP")
     * @Assert\Type(type="string", message="The type provided is invalid.")
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * User associated with this transaction.
     *
     * @Assert\Type(
     *     type="\EoneoPay\PhpSdk\Endpoints\User",
     *     message="The type provided is invalid."
     * )
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User
     */
    protected $user;
}
