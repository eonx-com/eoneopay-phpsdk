<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Traits\Requests\Payloads\CreditCardTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getCvc()
 * @method null|Expiry getExpiry()
 * @method null|string getName()
 * @method null|string getNumber()
 * @method null|string getToken()
 */
class CreditCard extends BaseDataTransferObject
{
    use CreditCardTrait;
}
