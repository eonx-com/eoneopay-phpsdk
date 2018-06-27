<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\Requests\Payloads\BankAccountTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

class BankAccount extends BaseDataTransferObject
{
    use BankAccountTrait;
}
