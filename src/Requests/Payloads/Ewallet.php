<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\Requests\Payloads\EwalletTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

class Ewallet extends BaseDataTransferObject
{
    use EwalletTrait;
}
