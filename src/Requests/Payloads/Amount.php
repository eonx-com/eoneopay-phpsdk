<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\Requests\Payloads\AmountTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getCurrency()
 * @method null|string getFees()
 * @method null|string getSubTotal()
 * @method null|string getTotal()
 */
class Amount extends BaseDataTransferObject
{
    use AmountTrait;
}
