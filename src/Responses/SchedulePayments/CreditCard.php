<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\SchedulePayments;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard as CreditCardPayload;
use EoneoPay\PhpSdk\Responses\SchedulePayment;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method null|CreditCardPayload getCreditCard()
 */
class CreditCard extends SchedulePayment
{
    /**
     * Credit card endpoint.
     *
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create", "get", "list"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCard|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $creditCard;
}
