<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Abstracts\AbstractDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class BankAccount extends AbstractDataTransferObject
{
    /**
     * Bank account bsb.
     *
     * @Assert\Type(type="string", groups={"create", "update"})
     * @Assert\Length(min="6", max="7", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $bsb;

    /**
     * Bank account name.
     *
     * @Assert\Type(type="string", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $name;

    /**
     * Bank account number.
     *
     * @Assert\Type(type="string", groups={"create", "update"})
     * @Assert\Length(min="6", max="10", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $number;

    /**
     * Get bank account bsb.
     *
     * @return null|string
     */
    public function getBsb(): ?string
    {
        return $this->bsb;
    }

    /**
     * Get name.
     *
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get bank account number.
     *
     * @return null|string
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * Set bank account bsb.
     *
     * @param null|string $bsb
     *
     * @return self
     */
    public function setBsb(?string $bsb): self
    {
        $this->bsb = $bsb;

        return $this;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return BankAccount
     */
    public function setName(string $name): BankAccount
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set bank account number.
     *
     * @param null|string $number
     *
     * @return self
     */
    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }
}
