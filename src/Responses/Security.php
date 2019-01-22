<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Traits\SecurityTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method null|string getActionUrl()
 * @method null|Amount getAmount()
 * @method null|string getCavv()
 * @method null|CreditCard getCreditCard()
 * @method null|string getEnrolmentStatus()
 * @method null|string getId()
 * @method null|string getPayload()
 * @method null|string getResponsePayload()
 * @method null|string getRequestPayload()
 * @method null|string getReturnUrl()
 * @method null|bool getSecured()
 * @method null|string getStatus()
 * @method null|string getXid()
 */
class Security extends AbstractResponse
{
    use SecurityTrait;

    /**
     * Amount.
     *
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create", "update", "delete"})
     *
     * @Groups({"create", "update", "get", "list"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Amount
     */
    protected $amount;

    /**
     * Credit card endpoint.
     *
     * @Groups({"create", "update", "get", "list"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCard
     */
    protected $creditCard;
}
