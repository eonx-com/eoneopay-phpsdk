<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Responses\Payloads;

trait ResponseTrait
{
    /**
     * Acquirer code
     *
     * @var null|string
     */
    protected $acquirerCode;

    /**
     * Acquirer message
     *
     * @var null|string
     */
    protected $acquirerMessage;

    /**
     * Gateway message
     *
     * @var null|string
     */
    protected $gatewayMessage;
}
