<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait MerchantTrait
{
    /**
     * @Assert\Email(groups={"create", "update"})
     * @Assert\NotBlank(groups={"create"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $email;

    /**
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $externalId;

    /**
     * @Assert\NotBlank(groups={"update", "delete"})
     * @Assert\Type(type="string", groups={"create", "update"})
     *
     * @var null|string
     */
    protected $id;

    /**
     * @var null|string
     */
    protected $apiKey;
}
