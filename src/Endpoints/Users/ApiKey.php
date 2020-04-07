<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Traits\Users\ApiKeyTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getCreatedAt()
 * @method string|null getKey()
 * @method User|null getTargetUser()
 * @method User|null getUser()
 * @method string|null getUpdatedAt()
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
 */
class ApiKey extends Entity
{
    use ApiKeyTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/users/%s/apikeys', $this->getUserId()),
            self::DELETE => \sprintf('/apikeys/%s', $this->getKey()),
        ];
    }

    /**
     * Get user id.
     *
     * @return string
     */
    private function getUserId(): string
    {
        return ($this->getUser() instanceof User) === true ? $this->getUser()->getId() ?? '' : '';
    }
}
