<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Transactions;

use EoneoPay\PhpSdk\Traits\TransactionTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

class TransactionResponse extends BaseDataTransferObject
{
    use TransactionTrait;
}