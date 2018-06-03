<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Transactions;

use EoneoPay\PhpSdk\Responses\Payloads\BankAccount;
use EoneoPay\PhpSdk\Responses\Payloads\Gateway;
use EoneoPay\PhpSdk\Responses\Payloads\Transactions\BankAccountTransaction;

class BankAccountTransactionResponse
{
    /**
     * @var \EoneoPay\PhpSdk\Responses\Payloads\BankAccount
     */
    private $bankAccount;

    /**
     * @var \EoneoPay\PhpSdk\Responses\Payloads\Gateway
     */
    private $gateway;

    /**
     * @var \EoneoPay\PhpSdk\Responses\Payloads\Transactions\BankAccountTransaction
     */
    private $transaction;

    /**
     * Get bank_account.
     *
     * @return null|\EoneoPay\PhpSdk\Responses\Payloads\BankAccount
     */
    public function getBankAccount(): ?BankAccount
    {
        return $this->bankAccount;
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
     * @return null|\EoneoPay\PhpSdk\Responses\Payloads\Transactions\BankAccountTransaction
     */
    public function getTransaction(): ?BankAccountTransaction
    {
        return $this->transaction;
    }

    /**
     * Set bank_account.
     *
     * @param \EoneoPay\PhpSdk\Responses\Payloads\BankAccount $bankAccount
     *
     * @return BankAccountTransactionResponse
     */
    public function setBankAccount(BankAccount $bankAccount): BankAccountTransactionResponse
    {
        $this->bankAccount = $bankAccount;

        return $this;
    }

    /**
     * Set gateway.
     *
     * @param \EoneoPay\PhpSdk\Responses\Payloads\Gateway $gateway
     *
     * @return BankAccountTransactionResponse
     */
    public function setGateway(Gateway $gateway): BankAccountTransactionResponse
    {
        $this->gateway = $gateway;

        return $this;
    }

    /**
     * Set transaction.
     *
     * @param \EoneoPay\PhpSdk\Responses\Payloads\Transactions\BankAccountTransaction $transaction
     *
     * @return BankAccountTransactionResponse
     */
    public function setTransaction(BankAccountTransaction $transaction): BankAccountTransactionResponse
    {
        $this->transaction = $transaction;

        return $this;
    }
}
