<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Repositories;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\ExceptionFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Repository;

class PaymentSourceRepository extends Repository
{
    /**
     * Find payment source by token.
     *
     * @param string $token Payment source token
     * @param string $apikey Api key
     *
     * @return \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     */
    public function findByToken(string $token, string $apikey): PaymentSource
    {
        try {
            return $this->getApiManager()->findOneBy(PaymentSource::class, $apikey, \compact('token'));
        } catch (InvalidApiResponseException $exception) {
            throw (new ExceptionFactory($exception))->create();
        }
    }
}
