<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait PaymentSourceTrait
{
    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $id;

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
     * @var string
     */
    protected $type;
}
