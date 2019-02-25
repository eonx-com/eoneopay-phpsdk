<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Exceptions\ClientException;
use EoneoPay\PhpSdk\Exceptions\CriticalException;
use EoneoPay\PhpSdk\Exceptions\RuntimeException;
use EoneoPay\PhpSdk\Exceptions\ValidationException;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException;

class ExceptionFactory
{
    /**
     * The error code.
     *
     * @var \EoneoPay\Externals\HttpClient\Exceptions\InvalidApiResponseException
     */
    private $exception;

    /**
     * Initialize the attribute.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException $exception
     */
    public function __construct(InvalidApiResponseException $exception)
    {
        $this->exception = $exception;
    }

    /**
     * Create exception object based on error code range.
     *
     * @return \EoneoPay\Utils\Exceptions\BaseException
     */
    public function create(): Exception
    {
        $content = \json_decode($this->exception->getResponse()->getContent(), true);

        $code = $content['code'] ?? $this->exception->getCode();

        $message = $content['message'] ?? $content['exception'] ?? '';

        if (($code >= 6000) && ($code <= 6999)) {
            return new ValidationException($message, $code);
        }

        if ($code >= 5000 && $code <= 5999) {
            return new RuntimeException($message, $code);
        }

        if ($code >= 4000 && $code <= 4999) {
            return new ClientException($message, $code);
        }

        return new CriticalException($message, $code);
    }
}