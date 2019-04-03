<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Traits\WebhookTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method string|null getId()
 * @method mixed[]|null getHeaders()
 * @method string|null getUrl()
 * @method User|null getUser()
 */
class Webhook extends Entity
{
    use WebhookTrait;

    /**
     * User associated with this webhook.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User
     */
    protected $user;

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/webhooks',
            self::UPDATE => \sprintf('/webhooks/%s', $this->id),
            self::LIST => '/webhooks',
            self::DELETE => \sprintf('/webhooks/%s', $this->id)
        ];
    }
}
