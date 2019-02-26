<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait UserTrait
{
    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $createdAt;
    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $email;
    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string User selected external id
     */
    protected $id;
    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $updatedAt;
}
