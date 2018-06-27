<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses;

use EoneoPay\PhpSdk\Traits\MerchantTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getApiKey()
 * @method null|string getEmail()
 * @method null|string getExternalId()
 * @method null|string getId()
 */
class Merchant extends BaseDataTransferObject
{
    use MerchantTrait;
}
