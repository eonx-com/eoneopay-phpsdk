<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

trait UserTrait
{
    /**
     * Created at date.
     *
     * @var string
     */
    protected $createdAt;

    /**
     * User email.
     *
     * @var string
     */
    protected $email;

    /**
     * User id.
     *
     * @var string User selected external id
     */
    protected $id;

    /**
     * Updated at date.
     *
     * @var string
     */
    protected $updatedAt;
}
