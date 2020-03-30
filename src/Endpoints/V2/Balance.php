<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Traits\BalanceTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getAvailable()
 * @method string|null getBalance()
 * @method string|null getCreditLimit()
 */
class Balance extends Entity
{
    use BalanceTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [];
    }
}
