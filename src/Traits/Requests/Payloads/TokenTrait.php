<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Requests\Payloads;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait TokenTrait
{
    /**
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Type(type="string", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $token;
}