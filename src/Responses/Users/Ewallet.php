<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users;

use EoneoPay\PhpSdk\Traits\Requests\Payloads\EwalletTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getName()
 * @method null|string getReference()
 * @method null|string getToken()
 */
class Ewallet extends BaseDataTransferObject
{
    use EwalletTrait;
}
