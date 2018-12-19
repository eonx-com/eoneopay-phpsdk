<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Traits\Requests\Payloads\CreditCardTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getCountry()
 * @method null|string getCvc()
 * @method null|Expiry getExpiry()
 * @method null|string getId()
 * @method null|string getIssuer()
 * @method null|string getMethod()
 * @method null|string getName()
 * @method null|string getNumber()
 * @method null|string getPan()
 * @method null|string getPrepaid()
 * @method null|string getScheme()
 * @method null|string getToken()
 */
class CreditCard extends BaseDataTransferObject
{
    use CreditCardTrait;
}
