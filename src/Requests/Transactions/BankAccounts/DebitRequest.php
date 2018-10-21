<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

class DebitRequest extends BankAccountTransactionRequest
{
    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => 'transactions/debit'
        ];
    }
}
