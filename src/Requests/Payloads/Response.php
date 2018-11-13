<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\Responses\Payloads\ResponseTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getAcquirerCode()
 * @method null|string getAcquirerMessage()
 * @method null|string getGatewayMessage()
 */
class Response extends BaseDataTransferObject
{
    use ResponseTrait;
}
