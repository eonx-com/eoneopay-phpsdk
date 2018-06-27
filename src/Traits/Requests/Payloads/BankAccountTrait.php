<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Requests\Payloads;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait BankAccountTrait
{
    /**
     * Bank account bsb.
     *
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create"})
     *
     * @Groups({"create", "update", "tokenise", "endpoints_validate"})
     *
     * @var null|string
     */
    protected $bsb;

    /**
     * Bank account name.
     *
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create", "update", "tokenise"})
     *
     * @Groups({"create", "update", "tokenise"})
     *
     * @var string
     */
    protected $name;

    /**
     * Bank account number.
     *
     * @Assert\Expression(
     *     "this.number or this.token",
     *     groups={"endpoints_validate"},
     *     message="field is required when token is not present."
     * )
     *
     * @Assert\NotBlank(groups={"create", "tokenise"})
     * @Assert\Type(type="string", groups={"create", "update", "tokenise"})
     *
     * @Groups({"create", "update", "tokenise", "endpoints_validate"})
     *
     * @var null|string
     */
    protected $number;

    /**
     * Bank account token.
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
