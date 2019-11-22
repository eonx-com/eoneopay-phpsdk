<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users;

use Symfony\Component\Serializer\Annotation\Groups;

trait ReferenceNumberTrait
{
    /**
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Ewallet
     */
    protected $ewallet;

    /**
     * @var string|null
     */
    protected $referenceNumber;

    /**
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $type;

    /**
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User
     */
    protected $user;
}
