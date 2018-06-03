<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Payloads\Transactions;

class BankAccountTransaction extends AbstractTransaction
{
    /**
     * @var string
     */
    private $remitterName;

    /**
     * Get remitter_name.
     *
     * @return null|string
     */
    public function getRemitterName(): ?string
    {
        return $this->remitterName;
    }

    /**
     * Set remitter_name.
     *
     * @param null|string $remitterName
     *
     * @return BankAccountTransaction
     */
    public function setRemitterName(?string $remitterName = null): BankAccountTransaction
    {
        $this->remitterName = $remitterName;

        return $this;
    }
}
