<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait UserTrait
{
    /**
     * Created at date
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $createdAt;

    /**
     * User email
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $email;

    /**
     * User id
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string User selected external id
     */
    protected $id;

    /**
     * Updated at date
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $updatedAt;
}
