<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse;
use EoneoPay\PhpSdk\Traits\TransactionTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

abstract class BankAccountTransactionRequest extends AbstractRequest
{
    use TransactionTrait;

    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\BankAccount|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $bankAccount;

    /**
     * @inheritdoc
     */
    public function expectObject(): string
    {
        return TransactionResponse::class;
    }
}
