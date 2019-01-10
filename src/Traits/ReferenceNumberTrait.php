<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait ReferenceNumberTrait
{
    /**
     * Reference number.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $referenceNumber;

    /**
     * User id.
     *
     * @Assert\NotBlank(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $userId;
}
