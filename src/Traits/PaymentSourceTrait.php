<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait PaymentSourceTrait
{
    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var mixed[]|null
     */
    protected $bin;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var mixed[]|null
     */
    protected $expiry;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $facility;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $id;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $name;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $pan;

    /**
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
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $updatedAt;
}
