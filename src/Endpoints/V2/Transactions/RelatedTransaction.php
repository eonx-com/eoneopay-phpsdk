<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\V2\Transactions;

use EoneoPay\PhpSdk\Endpoints\V2\Transaction;
use EoneoPay\PhpSdk\Interfaces\Endpoints\VersionedEndpointInterface;
use EoneoPay\PhpSdk\Traits\V2\Transactions\RelatedTransactionTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method Transaction[]|null getChildren()
 * @method Transaction[]|null getParents()
 */
class RelatedTransaction extends Entity implements VersionedEndpointInterface
{
    use RelatedTransactionTrait;

    /**
     * {@inheritdoc}
     */
    public function getVersion(): int
    {
        return 2;
    }

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::GET => \sprintf('/orders/%s/transactions/%s/related', $this->orderId, $this->transactionId)
        ];
    }
}
