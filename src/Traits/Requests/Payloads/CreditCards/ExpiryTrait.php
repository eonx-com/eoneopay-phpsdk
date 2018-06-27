<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Requests\Payloads\CreditCards;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait ExpiryTrait
{
    /**
     * Expire month.
     *
     * @Assert\NotBlank(groups={"create", "update", "tokenise"})
     * @Assert\Length(min="1", max="2", groups={"create", "update", "tokenise"})
     * @Assert\Type(type="string", groups={"create", "update", "tokenise"})
     *
     * @Groups({"create", "update", "tokenise", "endpoints_validate"})
     *
     * @var null|string
     */
    protected $month;

    /**
     * Expire year.
     *
     * @Assert\NotBlank(groups={"create", "update", "tokenise"})
     * @Assert\Length(min="4", max="4", groups={"create", "update", "tokenise"})
     * @Assert\Type(type="string", groups={"create", "update", "tokenise"})
     * @Assert\Type(type="numeric", groups={"create", "update", "tokenise"})
     *
     * @Groups({"create", "update", "tokenise", "endpoints_validate"})
     *
     * @var null|string
     */
    protected $year;
}