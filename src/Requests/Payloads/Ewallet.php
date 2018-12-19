<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\Requests\Payloads\EwalletTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getCurrency()
 * @method null|string getId()
 * @method null|string getName()
 * @method null|string getPan()
 * @method null|string getReference()
 * @method null|string getToken()
 */
class Ewallet extends BaseDataTransferObject
{
    use EwalletTrait;
}
