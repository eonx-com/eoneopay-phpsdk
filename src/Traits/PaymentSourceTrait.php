<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

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
     * @var string|null
     */
    protected $updatedAt;
}
