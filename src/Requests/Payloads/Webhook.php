<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\WebhookTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

class Webhook extends BaseDataTransferObject
{
    use WebhookTrait;
}
