<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Interfaces\Endpoints\TransactionInterface;
use EoneoPay\PhpSdk\Traits\TransactionTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getAction()
 * @method mixed[]|null getAllocation()
 * @method mixed[]|null getAmount()
 * @method bool|null getApproved()
 * @method string|null getCreatedAt()
 * @method string|null getId()
 * @method mixed[]|null getMetadata()
 * @method Transaction|null getParent()
 * @method PaymentSource|null getPaymentDestination()
 * @method PaymentSource|null getPaymentSource()
 * @method mixed[]|null getResponse()
 * @method mixed|null getSecurity()
 * @method string|null getStatementDescription()
 * @method string|null getStatus()
 * @method string|null getTransactionId()
 * @method string|null getUpdatedAt()
 * @method User|null getUser()
 */
class Transaction extends Entity implements TransactionInterface
{
    use TransactionTrait;

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/orders/%s/transactions/%s', $this->id, $this->transactionId),
            self::DELETE => \sprintf('/orders/%s/transactions/%s', $this->id, $this->transactionId),
            self::UPDATE => \sprintf('/orders/%s/transactions/%s', $this->id, $this->transactionId)
        ];
    }
}