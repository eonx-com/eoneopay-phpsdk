<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\Requests\Payloads\BankAccountTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getCountry()
 * @method null|string getCurrency()
 * @method null|string getId()
 * @method null|string getName()
 * @method null|string getNumber()
 * @method null|string getPan()
 * @method null|string getPrefix()
 * @method null|string getToken()
 */
class BankAccount extends BaseDataTransferObject
{
    use BankAccountTrait;
}
