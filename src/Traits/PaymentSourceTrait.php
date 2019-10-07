<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait PaymentSourceTrait
{
    /**
     * Created at date.
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * Payment source id.
     *
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     *
     * @var string
     */
    protected $id;

    /**
     * Payment source name.
     *
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $name;

    /**
     * Payment source pan.
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     *
     * @var string
     */
    protected $pan;

    /**
     * Payment source token.
     *
     * @var string|null
     */
    protected $token;

    /**
     * Payment source type discriminator.
     *
     * @Groups({"create", "update"})
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     *
     * @var string
     */
    protected $type;

    /**
     * Updated at date.
     *
     * @var string|null
     */
    protected $updatedAt;
}
