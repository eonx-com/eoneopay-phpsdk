<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users;

use Symfony\Component\Serializer\Annotation\Groups;

trait ApiKeyTrait
{
    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $key;

    /**
     * @Groups({"create"})
     *
     * @var string
     */
    protected $userId;
}
