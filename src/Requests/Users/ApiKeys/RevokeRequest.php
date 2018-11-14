<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Users\ApiKeys;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Traits\ApiKeyTrait;

class RevokeRequest extends AbstractRequest
{
    use ApiKeyTrait;

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
            self::DELETE => \sprintf('/users/%s/apikeys', $this->id)
        ];
    }
}
