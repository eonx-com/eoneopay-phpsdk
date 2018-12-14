<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Transactions;

use EoneoPay\PhpSdk\Requests\Payloads\BankAccount as BankAccountPayload;
use EoneoPay\PhpSdk\Responses\Transaction;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method null|BankAccountPayload getBankAccount()
 */
class BankAccount extends Transaction
{
    /**
     * Bank account endpoint.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\BankAccount
     */
    protected $bankAccount;
}
