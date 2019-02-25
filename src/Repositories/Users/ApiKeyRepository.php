<?php
/**
 * Created by PhpStorm.
 * User: Codeint
 * Date: 22/02/2019
 * Time: 14:36
 */

namespace EoneoPay\PhpSdk\Repositories\Users;

use EoneoPay\PhpSdk\Endpoints\Users\ApiKey;
use EoneoPay\PhpSdk\ExceptionFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Repository;

class ApiKeyRepository extends Repository
{
    /**
     * Create a new API Key
     *
     * @param string $apiKey
     * @param string $userId
     *
     * @return \EoneoPay\PhpSdk\Endpoints\Users\ApiKey|null
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     */
    public function createKey(string $apiKey, string $userId): ?ApiKey
    {
        try {
            return $this->getApiManager()->create($apiKey, new ApiKey(\compact('userId')));
        } catch (InvalidApiResponseException $exception) {
            throw (new ExceptionFactory($exception))->create();
        }
    }

    /**
     * Remove a key
     *
     * @param string $apiKey Master Key
     * @param string $key Key to remove
     *
     * @return bool
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     */
    public function deleteKey(string $apiKey, string $key): bool
    {
        try {
            return $this->getApiManager()->delete($apiKey, new ApiKey(\compact('key')));
        } catch (InvalidApiResponseException $exception) {
            throw (new ExceptionFactory($exception))->create();
        }
    }
}
