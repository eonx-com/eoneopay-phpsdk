<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads\CreditCards;

use EoneoPay\PhpSdk\Abstracts\AbstractDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class Expiry extends AbstractDataTransferObject
{
    /**
     * Expire month.
     *
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Length(min="1", max="2", groups={"create", "update"})
     * @Assert\Type(type="string", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $month;

    /**
     * Expire year.
     *
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Length(min="4", max="4", groups={"create", "update"})
     * @Assert\Type(type="string", groups={"create", "update"})
     * @Assert\Type(type="numeric", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $year;

    /**
     * Get expiry month.
     *
     * @return null|string
     */
    public function getMonth(): ?string
    {
        return $this->month;
    }

    /**
     * Get expiry year.
     *
     * @return null|string
     */
    public function getYear(): ?string
    {
        return $this->year;
    }

    /**
     * Set expiry month.
     *
     * @param null|string $month
     *
     * @return self
     */
    public function setMonth(?string $month = null): self
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Set expiry year.
     *
     * @param null|string $year
     *
     * @return self
     */
    public function setYear(?string $year = null): self
    {
        $this->year = $year;

        return $this;
    }
}
