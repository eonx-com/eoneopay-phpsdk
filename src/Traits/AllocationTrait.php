<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait AllocationTrait
{
    /**
     * Amount.
     *
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create"})
     * @Assert\Type(type="numeric", groups={"create"})
     * @Assert\GreaterThan(value="0", groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $amount;

    /**
     * Ewallet token.
     *
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $ewallet;
}
