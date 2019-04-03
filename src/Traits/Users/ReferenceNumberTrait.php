<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users;

use Symfony\Component\Serializer\Annotation\Groups;

trait ReferenceNumberTrait
{
    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $referenceNumber;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $userId;
}
