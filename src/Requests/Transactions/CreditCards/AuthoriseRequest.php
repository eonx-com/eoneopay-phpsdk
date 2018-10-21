<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

class AuthoriseRequest extends CreditCardTransactionRequest
{
    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => 'transactions/authorise',
            self::UPDATE => \sprintf('transactions/capture/%s', $this->originalId)
        ];
    }
}
