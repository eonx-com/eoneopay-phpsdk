<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Endpoints\V2\Transactions\Allocation;
use EoneoPay\PhpSdk\Traits\V2\TransactionTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getAction()
 * @method Allocation|null getAllocation()
 * @method Amount|null getAmount()
 * @method bool|null getApproved()
 * @method string|null getCreatedAt()
 * @method string|null getDescription()
 * @method string|null getFinalisedAt()
 * @method PaymentSource[]|null getFundingSources()
 * @method string|null getId()
 * @method mixed[]|null getMetadata()
 * @method Transaction[]|null getParents()
 * @method PaymentSource|null getPaymentDestination()
 * @method PaymentSource|null getPaymentSource()
 * @method mixed[]|null getResponse()
 * @method Security|null getSecurity()
 * @method int|null getState()
 * @method string|null getStatementDescription()
 * @method string|null getStatus()
 * @method string|null getTransactionId()
 * @method string|null getUpdatedAt()
 * @method User|null getUser()
 */
class Transaction extends Entity
{
    use TransactionTrait;

    /**
     * @inheritDoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/orders/%s/transactions/%s', $this->id, $this->transactionId),
            self::GET => \sprintf('/orders/%s/transactions/%s', $this->id, $this->transactionId),
        ];
    }
}