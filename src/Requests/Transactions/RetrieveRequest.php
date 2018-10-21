<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse;
use EoneoPay\PhpSdk\Traits\TransactionTrait;

class RetrieveRequest extends AbstractRequest
{
    use TransactionTrait;

    /**
     * @inheritdoc
     */
    public function expectObject(): string
    {
        return TransactionResponse::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::GET => \sprintf('transactions/retrieve/%s', $this->id)
        ];
    }
}
