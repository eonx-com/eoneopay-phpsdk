<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users;

use Symfony\Component\Serializer\Annotation\Groups;

trait ApiKeyTrait
{
    /**
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * The Groups annotation is deliberately empty.
     *
     * @Groups({"none"})
     *
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
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * @Groups({"get"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User|null
     */
    protected $user;
}
