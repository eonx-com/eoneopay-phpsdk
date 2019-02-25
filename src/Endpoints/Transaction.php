<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Interfaces\Endpoints\TransactionInterface;
use EoneoPay\PhpSdk\Traits\TransactionTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getAction()
 * @method mixed[]|null geAmount()
 * @method string|null getId()
 * @method PaymentSource|null getPaymentDestination()
 * @method PaymentSource|null getPaymentSource()
 * @method string|null getTransactionId()
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
