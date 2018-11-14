<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait ApiKeyTrait
{
    /**
     * @Assert\NotBlank(groups={"create", "delete"})
     * @Assert\Type(type="string", groups={"create", "delete"})
     *
     * @Groups({"create", "delete"})
     *
     * @var string User id
     */
    protected $id;

    /**
     * @Assert\NotBlank(groups={"delete"})
     * @Assert\Type(type="string", groups={"delete"})
     *
     * @Groups({"create", "delete"})
     *
     * @var string Api key
     */
    protected $key;
}
