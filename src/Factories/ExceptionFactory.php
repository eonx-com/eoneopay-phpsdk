<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Factories;

use EoneoPay\PhpSdk\Exceptions\ClientException;
use EoneoPay\PhpSdk\Exceptions\CriticalException;
use EoneoPay\PhpSdk\Exceptions\RuntimeException;
use EoneoPay\PhpSdk\Exceptions\ValidationException;
use EoneoPay\PhpSdk\Interfaces\Factories\ExceptionFactoryInterface;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException;

class ExceptionFactory implements ExceptionFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(InvalidApiResponseException $exception): Exception
    {
        $content = \json_decode($exception->getResponse()->getContent(), true);

        $code = $content['code'] ?? $exception->getCode();

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
