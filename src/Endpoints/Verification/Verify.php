<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Verification;

use EoneoPay\PhpSdk\Traits\Verification\VerifyTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getAmount()
 * @method string|null getToken()
 */
class Verify extends Entity
{
    use VerifyTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/verify/%s', $this->getToken())
        ];
    }
}
