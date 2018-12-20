<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Exceptions;

use EoneoPay\Utils\Exceptions\RuntimeException;

class ClientNotConfiguredException extends RuntimeException
{
    /**
     * @inheritdoc
     */
    public function getErrorCode(): int
    {
        return self::DEFAULT_ERROR_CODE_RUNTIME;
    }

    /**
     * @inheritdoc
     */
    public function getErrorSubCode(): int
    {
        return self::DEFAULT_ERROR_SUB_CODE;
    }
}
