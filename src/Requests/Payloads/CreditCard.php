<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Abstracts\AbstractDataTransferObject;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CreditCard extends AbstractDataTransferObject
{
    /**
     * Credit card cvc.
     *
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create"})
     * @Assert\Type(type="numeric", groups={"create"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $cvc;

    /**
     * Expiry object.
     *
     * @Assert\Valid(groups={"create"})
     * @Assert\NotBlank(groups={"create"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry
     */
    protected $expiry;

    /**
     * The name of card holder.
     *
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $name;

    /**
     * Credit card number.
     *
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create"})
     * @Assert\CardScheme(
     *     schemes={"VISA", "AMEX", "MASTERCARD"},
     *     groups={"create"}
     * )
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $number;

    /**
     * Get cvc.
     *
     * @return null|string
     */
    public function getCvc(): ?string
    {
        return $this->cvc;
    }

    /**
     * Get expiry object.
     *
     * @return null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry
     */
    public function getExpiry(): ?Expiry
    {
        return $this->expiry;
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
     * Get credit card number.
     *
     * @return null|string
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * Set cvc.
     *
     * @param null|string $cvc
     *
     * @return self
     */
    public function setCvc(?string $cvc = null): self
    {
        $this->cvc = $cvc;

        return $this;
    }

    /**
     * Set expiry object.
     *
     * @param null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry $expiry
     *
     * @return self
     */
    public function setExpiry(?Expiry $expiry = null): self
    {
        $this->expiry = $expiry;

        return $this;
    }

    /**
     * Set card holder name.
     *
     * @param null|string $name
     *
     * @return self
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set credit card number.
     *
     * @param null|string $number
     *
     * @return self
     */
    public function setNumber(?string $number = null): self
    {
        $this->number = $number;

        return $this;
    }
}
