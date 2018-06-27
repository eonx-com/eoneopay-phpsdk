<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse;
use EoneoPay\PhpSdk\Traits\TransactionTrait;

class RefundRequest extends AbstractRequest
{
    use TransactionTrait;

    /**
     * {@inheritdoc}
     */
    public function expectObject(): string
    {
        return TransactionResponse::class;
    }

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::DELETE => \sprintf('transactions/refund/%s', $this->id)
        ];
    }
}
