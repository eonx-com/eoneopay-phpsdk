<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Traits\Users\ReferenceNumberTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method getUserId()
 */
class ReferenceNumber extends Entity
{
    use ReferenceNumberTrait;

    /**
     * @var \EoneoPay\PhpSdk\Endpoints\Ewallet
     */
    protected $ewallet;

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/users/%s/reference', $this->getUserId())
        ];
    }
}