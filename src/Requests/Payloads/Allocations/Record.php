<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads\Allocations;

use EoneoPay\PhpSdk\Traits\AllocationTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

class Record extends BaseDataTransferObject
{
    use AllocationTrait;
}
