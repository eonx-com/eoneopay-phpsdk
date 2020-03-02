<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Tokens;

use EoneoPay\PhpSdk\Traits\Tokens\NominalTokenTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getCountry()
 * @method string|null getName()
 * @method string|null getNominalStatus()
 * @method boolean|null isOneTime()
 * @method string|null getToken()
 * @method string|null getType()
 */
class NominalToken extends Entity
{
    use NominalTokenTrait;

    /**
     * Nominal status of expired.
     *
     * @const string
     */
    public const STATUS_EXPIRED = 'expired';

    /**
     * Nominal status of not verified.
     *
     * @const string
     */
    public const STATUS_NOT_VERIFIED = 'not_verified';

    /**
     * Nominal status of pending.
     *
     * @const string
     */
    public const STATUS_PENDING = 'pending';

    /**
     * Nominal status of verfiied.
     *
     * @const string
     */
    public const STATUS_VERIFIED = 'verified';

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        // There are no actions directly on endpoint tokens
        return [];
    }
}
