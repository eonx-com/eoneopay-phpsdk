<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait WebhookTrait
{
    /**
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Type(type="string", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $event;

    /**
     * @Assert\NotBlank(groups={"delete", "update"})
     *
     * @Groups({"delete", "update"})
     *
     * @var null|string
     */
    protected $id;

    /**
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Type(type="integer", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var int
     */
    protected $payloadFormat;

    /**
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Url(
     *     groups={"create", "update"},
     *     protocols = {"http", "https"}
     * )
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $url;
}
