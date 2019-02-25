<?php
/**
 * Created by PhpStorm.
 * User: Codeint
 * Date: 22/02/2019
 * Time: 14:36
 */

namespace EoneoPay\PhpSdk\Repositories\Users;

use EoneoPay\PhpSdk\Endpoints\Users\ApiKey;
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
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     */
    public function createKey(string $apiKey, string $userId): ?ApiKey
    {
        $apiKey = $this->getApiManager()->create($apiKey, new ApiKey(\compact('userId')));

        if (($apiKey instanceof ApiKey) !== true) {
            return null;
        }

        return $apiKey;
    }


    /**
     * Remove a key
     *
     * @param string $apiKey Master Key
     * @param string $key Key to remove
     *
     * @return bool
     */
    public function deleteKey(string $apiKey, string $key): bool
    {
        return $this->getApiManager()->delete($apiKey, new ApiKey(\compact('key')));
    }
}
