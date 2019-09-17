<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Services\Webhooks\Exceptions;

use EoneoPay\PhpSdk\Exceptions\RuntimeException;

/**
 * An exception that is thrown when the requested entity class does not exist.
 */
final class InvalidEntityClassException extends RuntimeException
{
    /**
     * Constructs a new instance of InvalidEntityClassException.
     *
     * @param string $className The requested class name that does not exist.
     */
    public function __construct(string $className)
    {
        parent::__construct(
            'The requested entity class ({{ class }}) does not exist.',
            ['class' => $className],
            self::DEFAULT_ERROR_CODE_RUNTIME,
            null,
            1
        );
    }
}
