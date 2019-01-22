<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses;

use EoneoPay\PhpSdk\Traits\FeeTrait;

/**
 * @method string|null getCurrency()
 * @method string|null getFixed()
 * @method string|null getGroup()
 * @method string|null getType()
 * @method string|null getVariable()
 */
class Fee extends AbstractResponse
{
    use FeeTrait;
}
