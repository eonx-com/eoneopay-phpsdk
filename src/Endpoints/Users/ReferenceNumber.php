<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Traits\Users\ReferenceNumberTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method string getReferenceNumber()
 * @method string getType()
 * @method User getUser()
 * @method setReferenceNumber(string $reference)
 * @method setType(string $type)
 * @method setUser(User $user)
 */
class ReferenceNumber extends Entity
{
    use ReferenceNumberTrait;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Ewallet
     */
    protected $ewallet;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User
     */
    protected $user;

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
