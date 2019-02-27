<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait PaymentSourceTrait
{
    /**
     * Created at date
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * Payment source id
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $id;

    /**
     * Payment source name
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $name;

    /**
     * Payment source pan
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $pan;

    /**
     * Payment source token
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $token;

    /**
     * Payment source type discriminator.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $type;

    /**
     * Updated at date
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $updatedAt;
}
