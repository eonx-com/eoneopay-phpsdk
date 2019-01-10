<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users;

use EoneoPay\PhpSdk\Traits\ReferenceNumberTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method string|null getReferenceNumber()
 * @method string|null getUserId()
 */
class ReferenceNumber extends BaseDataTransferObject
{
    use ReferenceNumberTrait;
}
