<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Verification;

use EoneoPay\PhpSdk\Endpoints\Tokens\NominalToken;
use EoneoPay\PhpSdk\Traits\Verification\InitiateTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method NominalToken getToken()
 */
class Initiate extends Entity
{
    use InitiateTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/nominal/initiate/%s', $this->getToken()->getToken())
        ];
    }
}
