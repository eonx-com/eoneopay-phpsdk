<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Traits\UserTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

class User extends Entity
{
    use UserTrait;

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [];
    }
}
