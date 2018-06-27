<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

class DebitRequest extends CreditCardTransactionRequest
{
    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => 'transactions/debit'
        ];
    }
}
