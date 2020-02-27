<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Tokens;

use EoneoPay\PhpSdk\Traits\Tokens\NominalTokenTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getCountry()
 * @method string|null getName()
 * @method int|null getNominalStatus()
 * @method boolean|null isOneTime()
 * @method string|null getToken()
 * @method string|null getType()
 */
class NominalToken extends Entity
{
    use NominalTokenTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        // There are no actions directly on endpoint tokens
        return [];
    }
}
