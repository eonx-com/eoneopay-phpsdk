<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users;

use Symfony\Component\Serializer\Annotation\Groups;

trait ApiKeyTrait
{
    /**
     * @var string|null
     */
    protected $createdAt;

    /**
     * @var string|null
     */
    protected $key;

    /**
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $targetUser;

    /**
     * @var string|null
     */
    protected $updatedAt;

    /**
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;
}
