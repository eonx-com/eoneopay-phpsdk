<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users;

use EoneoPay\PhpSdk\Traits\ApiKeyTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getId()
 * @method null|string getKey()
 */
class ApiKey extends BaseDataTransferObject
{
    use ApiKeyTrait;
}
