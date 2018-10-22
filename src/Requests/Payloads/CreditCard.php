<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\Requests\Payloads\CreditCardTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

class CreditCard extends BaseDataTransferObject
{
    use CreditCardTrait;
}
