<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Transactions;

use EoneoPay\PhpSdk\Traits\TransactionTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getAmount()
 * @method null|bool getApproved()
 * @method null|string getCompletedAt()
 * @method null|string getCurrency()
 * @method null|string getId()
 * @method null|string getStatus()
 */
class TransactionResponse extends BaseDataTransferObject
{
    use TransactionTrait;
}
