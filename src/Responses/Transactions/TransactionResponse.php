<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Transactions;

use EoneoPay\PhpSdk\Interfaces\TransactionResponseInterface;
use EoneoPay\PhpSdk\Traits\TransactionTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

class TransactionResponse extends BaseDataTransferObject implements TransactionResponseInterface
{
    use TransactionTrait;

    /**
     * {@inheritdoc}
     */
    public function getAmount(): ?string
    {
        return $this->amount;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    /**
     * {@inheritdoc}
     */
    public function getSettledAt(): ?string
    {
        return $this->settledAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
}
