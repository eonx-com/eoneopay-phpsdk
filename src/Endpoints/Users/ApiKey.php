<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Annotations\Repository;
use EoneoPay\PhpSdk\Traits\Users\ApiKeyTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @Repository(repositoryClass="EoneoPay\PhpSdk\Repositories\Users\ApiKeyRepository")
 */
class ApiKey extends Entity
{
    use ApiKeyTrait;

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('http://payments.box/users/%s/apikeys', $this->id),
            self::DELETE => \sprintf('http://payments.box/apikeys/%s', $this->key)
        ];
    }
}