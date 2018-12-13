<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads\CreditCards;

use EoneoPay\PhpSdk\Traits\Requests\Payloads\CreditCards\ExpiryTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getMonth()
 * @method null|string getYear()
 */
class Expiry extends BaseDataTransferObject
{
    use ExpiryTrait;
}
