<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait UserTrait
{
    /**
     * Created at date.
     *
     * @Groups({"get"})
     *
     * @var string
     */
    protected $createdAt;

    /**
     * User email.
     *
     * @Groups({"create"})
     *
     * @var string
     */
    protected $email;

    /**
     * User id.
     *
     * @Groups({"create"})
     *
     * @var string User selected external id
     */
    protected $id;

    /**
     * Updated at date.
     *
     * @Groups({"get"})
     *
     * @var string
     */
    protected $updatedAt;
}
