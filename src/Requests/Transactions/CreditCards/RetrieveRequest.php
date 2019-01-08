<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Transactions\CreditCard;
use EoneoPay\PhpSdk\Traits\TransactionTrait;

class RetrieveRequest extends AbstractRequest
{
    use TransactionTrait;

    /**
     * @inheritdoc
     */
    public function expectObject(): string
    {
        return CreditCard::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::GET => \sprintf('/orders/%s/transactions/%s', $this->id, $this->secondaryId)
        ];
    }
}
