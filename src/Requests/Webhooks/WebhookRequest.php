<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Webhooks;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Webhook;
use EoneoPay\PhpSdk\Traits\WebhookTrait;

class WebhookRequest extends AbstractRequest
{
    use WebhookTrait;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return Webhook::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/webhooks/',
            self::UPDATE => '/webhooks/' . $this->id,
            self::LIST => '/webhooks/'
        ];
    }
}
