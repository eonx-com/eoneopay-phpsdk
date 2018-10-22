<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Webhooks;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Traits\WebhookTrait;

class DeleteRequest extends AbstractRequest
{
    use WebhookTrait;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::DELETE => '/webhooks/' . $this->id
        ];
    }
}
