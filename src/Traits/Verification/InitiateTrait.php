<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Verification;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait InitiateTrait
{
    /**
     * Payment source token.
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="EoneoPay\PhpSdk\Endpoints\Tokens\NominalToken")
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Tokens\NominalToken
     */
    protected $token;
}
