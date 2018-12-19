<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Requests\Payloads;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait BankAccountTrait
{
    /**
     * Bank account country.
     *
     * @Assert\NotBlank(groups={"create", "tokenise"})
     * @Assert\Type(type="string", groups={"create", "tokenise"})
     *
     * @Groups({"create", "tokenise"})
     *
     * @var null|string
     */
    protected $country;

    /**
     * Bank account country.
     *
     * @Groups({"create", "tokenise"})
     *
     * @var null|string
     */
    protected $currency;

    /**
     * Endpoint id.
     *
     * @Groups({"create", "tokenise"})
     *
     * @var null|string
     */
    protected $id;

    /**
     * Bank account name.
     *
     * @Assert\NotBlank(groups={"create", "tokenise"})
     * @Assert\Type(type="string", groups={"create", "tokenise"})
     *
     * @Groups({"create", "tokenise"})
     *
     * @var null|string
     */
    protected $name;

    /**
     * Bank account number.
     *
     * @Assert\NotBlank(groups={"create", "tokenise"})
     * @Assert\Type(type="string", groups={"create", "tokenise"})
     *
     * @Groups({"create", "tokenise"})
     *
     * @var null|string
     */
    protected $number;

    /**
     * Bank account pan.
     *
     * @Groups({"create", "tokenise"})
     *
     * @var null|string
     */
    protected $pan;

    /**
     * Bank account prefix.
     *
     * @Assert\NotBlank(groups={"create", "tokenise"})
     * @Assert\Type(type="string", groups={"create", "tokenise"})
     *
     * @Groups({"create", "tokenise"})
     *
     * @var null|string
     */
    protected $prefix;

    /**
     * Bank account token.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $token;
}
