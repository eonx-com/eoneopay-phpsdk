<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Verification;

use EoneoPay\PhpSdk\Traits\Verification\VerifyTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;
use EoneoPay\PhpSdk\Endpoints\Tokens\NominalToken;

/**
 * @method string|null getAmount()
 * @method NominalToken getToken()
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
