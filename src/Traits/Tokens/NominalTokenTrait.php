<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Tokens;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait NominalTokenTrait
{
    /**
     * Get country.
     *
     * @var string|null
     */
    protected $country;

    /**
     * Get token name.
     *
     * @var string|null
     */
    protected $name;

    /**
     * Get token nominal status.
     *
     * @var int
     */
    protected $nominalStatus;

    /**
     * Get if token is oneTime.
     *
     * @var boolean
     */
    protected $oneTime;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     *
     * @var string|null
     *
     * @Groups({"create"})
     */
    protected $token;

    /**
     * Get token endpoint type.
     *
     * @var string|null
     */
    protected $type;
}