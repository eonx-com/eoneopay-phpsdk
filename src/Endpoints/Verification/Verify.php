<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Verification;

use EoneoPay\PhpSdk\Endpoints\Tokens\NominalToken;
use EoneoPay\PhpSdk\Traits\Verification\VerifyTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getAmount()
 * @method NominalToken getToken()
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
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
            self::CREATE => \sprintf('/nominal/verify/%s', $this->getToken()->getToken())
        ];
    }
}
