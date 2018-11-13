<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

class SecondaryRequest extends CreditCardTransactionRequest
{
    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::UPDATE => \sprintf('transactions/%s', $this->originalId),
            self::DELETE => \sprintf('transactions/%s', $this->originalId)
        ];
    }
}
