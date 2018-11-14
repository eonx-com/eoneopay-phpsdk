<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Requests\Payloads;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait EwalletTrait
{
    /**
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
     * Ewallet reference.
     *
     * @Assert\NotBlank(groups={"create", "tokenise"})
     * @Assert\Type(type="string", groups={"create", "update", "tokenise"})
     *
     * @Groups({"create", "update", "tokenise"})
     *
     * @var null|string
     */
    protected $reference;

    /**
     * Ewallet token.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $token;
}
