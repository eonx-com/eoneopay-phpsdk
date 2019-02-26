<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait UserTrait
{
    /**
     * Email address.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $email;

    /**
     * User id.
     *
     * @var string|null
     */
    protected $id;
}
