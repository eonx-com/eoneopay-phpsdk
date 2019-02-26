<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users;

use Symfony\Component\Serializer\Annotation\Groups;

trait ApiKeyTrait
{
    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $key;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $targetUser;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;
}
