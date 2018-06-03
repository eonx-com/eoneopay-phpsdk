<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Payloads\Transactions;

use EoneoPay\PhpSdk\Responses\Payloads\Transactions\CreditCards\Security;

class CreditCardTransaction extends AbstractTransaction
{
    /**
     * @var string
     */
    private $recurringId;

    /**
     * @var \EoneoPay\PhpSdk\Responses\Payloads\Transactions\CreditCards\Security
     */
    private $security;

    /**
     * Get recurring_id.
     *
     * @return null|string
     */
    public function getRecurringId(): ?string
    {
        return $this->recurringId;
    }

    /**
     * Get security.
     *
     * @return null|\EoneoPay\PhpSdk\Responses\Payloads\Transactions\CreditCards\Security
     */
    public function getSecurity(): ?Security
    {
        return $this->security;
    }

    /**
     * Set recurring_id.
     *
     * @param null|string $recurringId
     *
     * @return CreditCardTransaction
     */
    public function setRecurringId(?string $recurringId = null): CreditCardTransaction
    {
        $this->recurringId = $recurringId;

        return $this;
    }

    /**
     * Set security.
     *
     * @param \EoneoPay\PhpSdk\Responses\Payloads\Transactions\CreditCards\Security $security
     *
     * @return CreditCardTransaction
     */
    public function setSecurity(Security $security): CreditCardTransaction
    {
        $this->security = $security;

        return $this;
    }
}
