<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Traits\Users\ReferenceNumberTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string getReferenceNumber()
 * @method string getType()
 * @method User getUser()
 * @method $this setReferenceNumber(string $reference)
 * @method $this setType(string $type)
 * @method $this setUser(User $user)
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
 */
class ReferenceNumber extends Entity
{
    use ReferenceNumberTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/reference',
        ];
    }
}
