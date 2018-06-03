<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Transactions;

use EoneoPay\PhpSdk\Responses\Payloads\CreditCard;
use EoneoPay\PhpSdk\Responses\Payloads\Gateway;
use EoneoPay\PhpSdk\Responses\Payloads\Transactions\CreditCardTransaction;

class CreditCardTransactionResponse
{
    /**
     * @var \EoneoPay\PhpSdk\Responses\Payloads\CreditCard
     */
    private $creditCard;

    /**
     * @var \EoneoPay\PhpSdk\Responses\Payloads\Gateway
     */
    private $gateway;

    /**
     * @var \EoneoPay\PhpSdk\Responses\Payloads\Transactions\CreditCardTransaction
     */
    private $transaction;

    /**
     * Get credit_card.
     *
     * @return null|\EoneoPay\PhpSdk\Responses\Payloads\CreditCard
     */
    public function getCreditCard(): ?CreditCard
    {
        return $this->creditCard;
    }

    /**
     * Get gateway.
     *
     * @return null|\EoneoPay\PhpSdk\Responses\Payloads\Gateway
     */
    public function getGateway(): ?Gateway
    {
        return $this->gateway;
    }

    /**
     * Get transaction.
     *
     * @return null|\EoneoPay\PhpSdk\Responses\Payloads\Transactions\CreditCardTransaction
     */
    public function getTransaction(): ?CreditCardTransaction
    {
        return $this->transaction;
    }

    /**
     * Set credit_card.
     *
     * @param \EoneoPay\PhpSdk\Responses\Payloads\CreditCard $creditCard
     *
     * @return CreditCardTransactionResponse
     */
    public function setCreditCard(CreditCard $creditCard): CreditCardTransactionResponse
    {
        $this->creditCard = $creditCard;

        return $this;
    }

    /**
     * Set gateway.
     *
     * @param \EoneoPay\PhpSdk\Responses\Payloads\Gateway $gateway
     *
     * @return CreditCardTransactionResponse
     */
    public function setGateway(Gateway $gateway): CreditCardTransactionResponse
    {
        $this->gateway = $gateway;

        return $this;
    }

    /**
     * Set transaction.
     *
     * @param \EoneoPay\PhpSdk\Responses\Payloads\Transactions\CreditCardTransaction $transaction
     *
     * @return CreditCardTransactionResponse
     */
    public function setTransaction(CreditCardTransaction $transaction): CreditCardTransactionResponse
    {
        $this->transaction = $transaction;

        return $this;
    }
}
