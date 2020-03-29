<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\Users\WebhookSubscriptions\SubscribedActivity;
use EoneoPay\PhpSdk\Traits\WebhookTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method SubscribedActivity[]|null getActivities()
 * @method string|null getId()
 * @method mixed[]|null getHeaders()
 * @method string|null getMethod()
 * @method string|null getSerializationFormat()
 * @method string|null getUrl()
 * @method User|null getUser()
 * @method $this setHeaders(array $headers)
 * @method $this setMethod(string $method)
 * @method $this setSerializationFormat(string $serializationFormat)
 * @method $this setUrl(string $url)
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
 */
class Webhook extends Entity
{
    use WebhookTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/webhooks',
            self::UPDATE => \sprintf('/webhooks/%s', $this->id),
            self::LIST => '/webhooks',
            self::DELETE => \sprintf('/webhooks/%s', $this->id),
        ];
    }
}
