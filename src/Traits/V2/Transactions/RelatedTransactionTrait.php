<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\V2\Transactions;

use Symfony\Component\Validator\Constraints as Assert;

trait RelatedTransactionTrait
{
    /**
     * Children transactions for given order and transaction id.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\V2\Transaction[]|null
     */
    protected $children;

    /**
     * Order id.
     *
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $orderId;

    /**
     * Parent transactions for given order and transaction id.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\V2\Transaction[]|null
     */
    protected $parents;

    /**
     * Transaction id.
     *
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     *
     * @var string|null
     */
    protected $transactionId;
}
