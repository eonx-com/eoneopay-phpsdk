<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait FeeTrait
{
    /**
     * Currency.
     *
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Currency(groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $currency;

    /**
     * Fixed fee rate.
     *
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Type(type="numeric", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $fixed;

    /**
     * Endpoint group as string.
     *
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Type(type="string", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $group;

    /**
     * Fee type.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $type;

    /**
     * Variable fee rate.
     *
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Type(type="numeric", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $variable;
}
