<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\Requests\Payloads\TokenTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

class Token extends BaseDataTransferObject
{
    use TokenTrait;
}
