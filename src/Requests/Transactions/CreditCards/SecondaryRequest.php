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
            self::UPDATE => \sprintf('/orders/%s/transactions/%s', $this->id, $this->secondaryId),
            self::DELETE => \sprintf('/orders/%s/transactions/%s', $this->id, $this->secondaryId)
        ];
    }
}
