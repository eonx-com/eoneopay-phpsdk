<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Exceptions;

use EoneoPay\Utils\Exceptions\RuntimeException;

class InvalidResponseClass extends RuntimeException
{
    /**
     * @inheritdoc
     */
    public function getErrorCode(): int
    {
        return self::DEFAULT_ERROR_CODE_RUNTIME + 10;
    }

    /**
     * @inheritdoc
     */
    public function getErrorSubCode(): int
    {
        return 1;
    }
}
