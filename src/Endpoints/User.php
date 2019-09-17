<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Traits\UserTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getCreatedAt()
 * @method string|null getEmail()
 * @method string|null getId()
 * @method string|null getUpdatedAt()
 */
class User extends Entity
{
    use UserTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return
            [
                self::CREATE => \sprintf('/users/%s', $this->getId()),
                self::GET => '/me',
            ];
    }
}
