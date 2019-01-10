<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Requests\Payloads;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait EwalletTrait
{
    /**
     * Ewallet currency.
     *
     * @Groups({"create", "update", "tokenise"})
     *
     * @var null|string
     */
    protected $currency;

    /**
     * Ewallet id.
     *
     * @Assert\NotBlank(groups={"new"})
     * @Assert\Type(type="string", groups={"new"})
     *
     * @Groups({"new"})
     *
     * @var string
     */
    protected $id;

    /**
     * Ewallet user's name.
     *
     * @Assert\NotBlank(groups={"create", "tokenise"})
     * @Assert\Type(type="string", groups={"create", "update", "tokenise"})
     *
     * @Groups({"create", "update", "tokenise"})
     *
     * @var string
     */
    protected $name;

    /**
     * Ewallet pan.
     *
     * @Groups({"create", "update", "tokenise"})
     *
     * @var null|string
     */
    protected $pan;

    /**
     * Ewallet reference.
     *
     * @Assert\NotBlank(groups={"create", "tokenise"})
     * @Assert\Type(type="string", groups={"create", "update", "tokenise"})
     * @Assert\Expression(
     *     "this.reference or this.token",
     *     groups={"get"},
     *     message="This field is required when token is not present."
     * )
     *
     * @Groups({"create", "update", "tokenise"})
     *
     * @var null|string
     */
    protected $reference;

    /**
     * Ewallet token.
     *
     * @Assert\Expression(
     *     "this.token or this.reference",
     *     groups={"get"},
     *     message="This field is required when reference is not present."
     * )
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $token;
}
