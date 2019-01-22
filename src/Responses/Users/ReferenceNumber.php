<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users;

use EoneoPay\PhpSdk\Responses\AbstractResponse;
use EoneoPay\PhpSdk\Traits\ReferenceNumberTrait;

/**
 * @method string|null getReferenceNumber()
 * @method string|null getUserId()
 */
class ReferenceNumber extends AbstractResponse
{
    use ReferenceNumberTrait;
}
