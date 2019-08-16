<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Services\Webhooks\Exceptions;

use EoneoPay\PhpSdk\Exceptions\RuntimeException;

class DeserializedObjectNotEntityException extends RuntimeException
{
    /**
     * Constructs a new instance of InvalidEntityClassException.
     *
     * @param mixed $instance
     *
     * @return void
     */
    public function __construct($instance)
    {
        parent::__construct(
            'The deserialized object ({{ class }}) is not an Entity.',
            ['class' => \get_class($instance)],
            self::DEFAULT_ERROR_CODE_RUNTIME,
            null,
            2
        );
    }
}
