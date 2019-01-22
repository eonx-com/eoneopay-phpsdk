<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users;

use EoneoPay\PhpSdk\Responses\AbstractResponse;
use EoneoPay\PhpSdk\Traits\ApiKeyTrait;

/**
 * @method null|string getId()
 * @method null|string getKey()
 */
class ApiKey extends AbstractResponse
{
    use ApiKeyTrait;
}
