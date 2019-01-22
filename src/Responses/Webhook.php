<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses;

use EoneoPay\PhpSdk\Traits\WebhookTrait;

/**
 * @method null|string getEvent()
 * @method null|int getPayloadFormat()
 * @method null|string getId()
 * @method null|string getUrl()
 */
class Webhook extends AbstractResponse
{
    use WebhookTrait;
}
