<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Abstracts\AbstractDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class Transaction extends AbstractDataTransferObject
{
    /**
     * Amount.
     *
     * @Assert\NotBlank(groups={"create", "delete", "update"})
     * @Assert\Type(type="string", groups={"create", "delete", "update"})
     * @Assert\Type(type="numeric", groups={"create", "delete", "update"})
     * @Assert\GreaterThan(value="0", groups={"create", "delete", "update"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $amount;

    /**
     * Currency.
     *
     * @Assert\Currency(groups={"create", "delete", "update"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $currency;

    /**
     * Reference.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $reference;

    /**
     * Request id.
     *
     * @Assert\NotBlank(groups={"create", "delete", "update"})
     * @Assert\Type(type="string", groups={"create", "delete", "update"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $requestId;

    /**
     * Statement Description.
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var null|string
     */
    protected $statementDescription;

    /**
     * Get amount.
     *
     * @return null|string
     */
    public function getAmount(): ?string
    {
        return $this->amount;
    }

    /**
     * Get currency.
     *
     * @return null|string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * Get Transaction Id.
     *
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get reference.
     *
     * @return null|string
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * Get request_id.
     *
     * @return null|string
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    /**
     * Get statement description.
     *
     * @return null|string
     */
    public function getStatementDescription(): ?string
    {
        return $this->statementDescription;
    }

    /**
     * Set amount.
     *
     * @param null|string $amount
     *
     * @return self
     */
    public function setAmount(?string $amount = null): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Set currency.
     *
     * @param null|string $currency
     *
     * @return self
     */
    public function setCurrency(?string $currency = null): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Set Transaction Id.
     *
     * @param null|string $id
     *
     * @return self
     */
    public function setId(?string $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set reference.
     *
     * @param null|string $reference
     *
     * @return self
     */
    public function setReference(?string $reference = null): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Set request_id.
     *
     * @param null|string $requestId
     *
     * @return Transaction
     */
    public function setRequestId(?string $requestId): Transaction
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * Set statement description.
     *
     * @param null|string $statementDescription
     *
     * @return self
     */
    public function setStatementDescription(?string $statementDescription = null): self
    {
        $this->statementDescription = $statementDescription;

        return $this;
    }
}
