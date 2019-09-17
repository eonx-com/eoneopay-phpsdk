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

final class ExceptionFactory implements ExceptionFactoryInterface
{
    /**
     * @noinspection MultipleReturnStatementsInspection Creating exceptions in this manner is most efficient
     *
     * {@inheritdoc}
     */
    public function create(InvalidApiResponseException $exception): Exception
    {
        $content = \json_decode($exception->getResponse()->getContent(), true);

        $code = $content['code'] ?? $exception->getCode();

        $subCode = $content['sub_code'] ?? 0;

        $message = $content['message'] ?? $content['exception'] ?? '';

        if (($code >= 6000) && ($code <= 6999)) {
            return new ValidationException(
                $message,
                null,
                $code,
                $exception,
                null,
                $subCode
            );
        }

        if ($code >= 5000 && $code <= 5999) {
            return new RuntimeException(
                $message,
                null,
                $code,
                $exception,
                $subCode
            );
        }

        if ($code >= 4000 && $code <= 4999) {
            return new ClientException(
                $message,
                null,
                $code,
                $exception,
                $subCode
            );
        }

        return new CriticalException(
            $message,
            null,
            $code,
            $exception,
            $subCode
        );
    }
}
