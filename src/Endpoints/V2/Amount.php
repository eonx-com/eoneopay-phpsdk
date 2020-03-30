<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Traits\AmountTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getCurrency()
 * @method string|null getPaymentFee()
 * @method string|null getSubtotal()
 * @method string|null getTotal()
 */
class Amount extends Entity
{
    use AmountTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        // There are no actions directly on amounts
        return [];
    }
}