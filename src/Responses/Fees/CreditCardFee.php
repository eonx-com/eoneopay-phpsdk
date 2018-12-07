<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Fees;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Responses\Fee;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method null|CreditCard getCreditCard()
 */
class CreditCardFee extends Fee
{
    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCard|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $creditCard;
}
