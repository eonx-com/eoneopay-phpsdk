<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Traits\WebhookTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method mixed[]|null getActivities()
 * @method string|null getId()
 * @method mixed[]|null getHeaders()
 * @method string|null getUrl()
 * @method User|null getUser()
 * @method $this setUrl(string $url)
 * @method $this setHeaders(array $headers)
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
