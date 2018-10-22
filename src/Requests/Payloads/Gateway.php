<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\Requests\Payloads\GatewayTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

class Gateway extends BaseDataTransferObject
{
    use GatewayTrait;
}
