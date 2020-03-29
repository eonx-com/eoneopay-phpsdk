<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\V1\Amount as V1Amount;

/**
 * @method string|null getCurrency()
 * @method string|null getPaymentFee()
 * @method string|null getSubtotal()
 * @method string|null getTotal()
 *
 * @deprecated Use V1 Amount object.
 */
class Amount extends V1Amount
{
}
