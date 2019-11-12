<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait PaymentSourceTrait
{
    /**
     * Created at date.
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * Payment source id.
     *
     * @Groups({"get"})
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
     * @Groups({"create", "get"})
     *
     * @var string
     */
    protected $pan;

    /**
     * Payment source token.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $token;

    /**
     * Payment source type discriminator.
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $type;

    /**
     * Updated at date.
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $updatedAt;
}
