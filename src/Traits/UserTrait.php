<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait UserTrait
{
    /**
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var string User id
     */
    protected $id;

    /**
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create"})
     * @Assert\Email(
     *     groups={"create"},
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     *
     * @Groups({"create"})
     *
     * @var string User email address
     */
    protected $email;

    /**
     * @Groups({"create"})
     *
     * @var string|null Password
     */
    protected $password;
}
