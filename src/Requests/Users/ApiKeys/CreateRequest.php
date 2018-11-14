<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Users\ApiKeys;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Users\ApiKey;
use EoneoPay\PhpSdk\Traits\ApiKeyTrait;

class CreateRequest extends AbstractRequest
{
    use ApiKeyTrait;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return ApiKey::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/users/%s/apikeys', $this->id)
        ];
    }
}
