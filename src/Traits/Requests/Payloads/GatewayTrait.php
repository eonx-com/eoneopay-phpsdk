<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Requests\Payloads;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait GatewayTrait
{
    /**
     * Certificate.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string $certificate
     */
    protected $certificate;

    /**
     * The information.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string $info
     */
    protected $info;

    /**
     * Line of business.
     *
     * @Assert\NotBlank(groups={"create", "delete", "get", "update"})
     * @Assert\Type(type="string", groups={"create", "delete", "get", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $lineOfBusiness;

    /**
     * Password.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string $password
     */
    protected $password;

    /**
     * Service.
     *
     * @Assert\NotBlank(groups={"create", "delete", "get", "update"})
     * @Assert\Type(type="string", groups={"create", "delete", "get", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string $service
     */
    protected $service;

    /**
     * Username.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string $username
     */
    protected $username;
}
