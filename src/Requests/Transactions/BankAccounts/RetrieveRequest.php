<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Transactions\BankAccount;
use EoneoPay\PhpSdk\Traits\TransactionTrait;

class RetrieveRequest extends AbstractRequest
{
    use TransactionTrait;

    /**
     * @inheritdoc
     */
    public function expectObject(): string
    {
        return BankAccount::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::GET => \sprintf('transactions/%s', $this->id)
        ];
    }
}
