<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Abstracts\Requests\Transactions;

use EoneoPay\PhpSdk\Abstracts\Requests\AbstractTransactionRequest;
use EoneoPay\PhpSdk\Responses\Transactions\BankAccountTransactionResponse;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractBankAccountRequest extends AbstractTransactionRequest
{
    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\BankAccount|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $bankAccount;

    /**
     * Specify the expected returned object.
     *
     * @return string
     */
    public function expectObject(): ?string
    {
        return BankAccountTransactionResponse::class;
    }

    /**
     * Get bank_account.
     *
     * @return null|\EoneoPay\PhpSdk\Requests\Payloads\BankAccount|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }
}
