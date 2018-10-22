<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Requests\Payloads;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait CreditCardTrait
{
    /**
     * Credit card cvc.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $cvc;

    /**
     * Expiry object.
     *
     * @Assert\Expression(
     *     "(this.number and this.expiry) or this.token",
     *     groups={"endpoints_validate"},
     *     message="field is required."
     * )
     * @Assert\Valid(groups={"create", "tokenise"})
     * @Assert\NotBlank(groups={"create", "tokenise"})
     *
     * @Groups({"create", "update", "tokenise", "endpoints_validate"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry
     */
    protected $expiry;

    /**
     * The name of card holder.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $name;

    /**
     * Credit card number.
     *
     * @Assert\Expression(
     *     "this.number or this.token",
     *     groups={"endpoints_validate"},
     *     message="field is required when token is not present."
     * )
     * @Assert\NotBlank(groups={"create", "tokenise"})
     * @Assert\Type(type="string", groups={"create", "tokenise"})
     * @Assert\CardScheme(
     *     schemes={"VISA", "AMEX", "MASTERCARD"},
     *     groups={"create", "tokenise"}
     * )
     *
     * @Groups({"create", "update", "tokenise", "endpoints_validate"})
     *
     * @var null|string
     */
    protected $number;

    /**
     * Credit card token.
     *
     * @Assert\Expression(
     *     "this.number or this.token",
     *     groups={"endpoints_validate"},
     *     message="field is required when number is not present."
     * )
     *
     * @Groups({"create", "update", "tokenise", "endpoints_validate"})
     *
     * @var null|string
     */
    protected $token;
}
