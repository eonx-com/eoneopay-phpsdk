<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Traits\V2\EwalletTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method Balance|null getBalances()
 * @method string|null getCreatedAt()
 * @method string|null getCurrency()
 * @method string|null getId()
 * @method string|null getPan()
 * @method bool getPrimary()
 * @method string|null getReference()
 * @method string|null getType()
 * @method string|null getUpdatedAt()
 * @method User|null getUser()
 */
class Ewallet extends Entity
{
    use EwalletTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        // Use V1 endpoints.
        return [];
    }
}
