<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users;

use Symfony\Component\Serializer\Annotation\Groups;

trait ReferenceNumberTrait
{
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
}
