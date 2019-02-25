<?php
/**
 * Created by PhpStorm.
 * User: Codeint
 * Date: 22/02/2019
 * Time: 16:24
 */

namespace EoneoPay\PhpSdk\Traits\Users;

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
