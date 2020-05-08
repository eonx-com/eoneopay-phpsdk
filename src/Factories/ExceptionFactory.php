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
     * @var string[]
     */
    private static $keysForMessage = ['message', 'exception'];

    /**
     * @noinspection MultipleReturnStatementsInspection Creating exceptions in this manner is most efficient
     *
     * {@inheritdoc}
     */
    public function create(InvalidApiResponseException $exception): Exception
    {
        $rawContent = $exception->getResponse()->getContent();
        $content = \json_decode($rawContent, true);
        $code = $content['code'] ?? $exception->getCode();
        $subCode = $content['sub_code'] ?? 0;
        $message = $this->getMessage($content);

        if ($message === null) {
            $message = \sprintf('Could not resolve message for raw content: "%s"', $rawContent);
        }

        if (($code >= 6000) && ($code <= 6999)) {
            return new ValidationException(
                $message,
                null,
                $code,
                $exception,
                $content['violations'] ?? [],
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

    private function getMessage($message): ?string
    {
        if (\is_string($message)) {
            return $message;
        }

        if (\is_array($message)) {
            foreach (static::$keysForMessage as $key) {
                if (isset($message[$key]) === false) {
                    continue;
                }

                $getMessage = $this->getMessage($message[$key]);

                if ($getMessage !== null) {
                    return $getMessage;
                }
            }
        }

        return null;
    }
}
