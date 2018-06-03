<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Payloads\Transactions;

/**
 * @SuppressWarnings(PHPMD.ShortVariable) id a required name of the payload.
 */
abstract class AbstractTransaction
{
    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var bool
     */
    private $approved;

    /**
     * @var string
     */
    private $completedAt;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $requestId;

    /**
     * @var string
     */
    private $statementDescriptor;

    /**
     * @var string
     */
    private $status;

    /**
     * Get action.
     *
     * @return null|string
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

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
     * Get completed_at.
     *
     * @return null|string
     */
    public function getCompletedAt(): ?string
    {
        return $this->completedAt;
    }

    /**
     * Get created_at.
     *
     * @return null|string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
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
     * Get id.
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
     * Get statement_descriptor.
     *
     * @return null|string
     */
    public function getStatementDescriptor(): ?string
    {
        return $this->statementDescriptor;
    }

    /**
     * Get status.
     *
     * @return null|string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Get approved.
     *
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->approved ?? false;
    }

    /**
     * Set action.
     *
     * @param string $action
     *
     * @return self
     */
    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Set amount.
     *
     * @param string $amount
     *
     * @return self
     */
    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Set approved.
     *
     * @param null|bool $approved
     *
     * @return self
     */
    public function setApproved(?bool $approved = null): self
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Set completed_at.
     *
     * @param null|string $completedAt
     *
     * @return self
     */
    public function setCompletedAt(?string $completedAt = null): self
    {
        $this->completedAt = $completedAt;

        return $this;
    }

    /**
     * Set created_at.
     *
     * @param string $createdAt
     *
     * @return self
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set currency.
     *
     * @param string $currency
     *
     * @return self
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Set id.
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set reference.
     *
     * @param string $reference
     *
     * @return self
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Set request_id.
     *
     * @param string $requestId
     *
     * @return self
     */
    public function setRequestId(string $requestId): self
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * Set statement_descriptor.
     *
     * @param string $statementDescriptor
     *
     * @return self
     */
    public function setStatementDescriptor(string $statementDescriptor): self
    {
        $this->statementDescriptor = $statementDescriptor;

        return $this;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
