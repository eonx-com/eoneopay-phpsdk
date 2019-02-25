<?php
/**
 * Created by PhpStorm.
 * User: Codeint
 * Date: 22/02/2019
 * Time: 16:36
 */

namespace EoneoPay\PhpSdk\Repositories\Users;

use EoneoPay\PhpSdk\Endpoints\Users\Ewallet;
use EoneoPay\PhpSdk\Endpoints\Users\User;
use EoneoPay\PhpSdk\ExceptionFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Repository;

class UserRepository extends Repository
{
    /**
     * Create a user
     *
     * @param string $apiKey
     * @param string $id User selected external id
     * @param string $email User selected email address
     *
     * @return \EoneoPay\PhpSdk\Endpoints\Users\User
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     */
    public function create(string $apiKey, string $id, string $email): User
    {
        try {
            return $this->getApiManager()->create($apiKey, new User(\compact('id', 'email')));
        } catch (InvalidApiResponseException $exception) {
            throw (new ExceptionFactory($exception))->create();
        }
    }

    /**
     * Create a new EwalletTrait for user
     *
     * @param string $apiKey
     *
     * @return \EoneoPay\PhpSdk\Endpoints\Users\Ewallet
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function createEwallet(string $apiKey): Ewallet
    {
        try {
            return $this->getApiManager()->create($apiKey, new Ewallet());
        } catch (InvalidApiResponseException $exception) {
            throw (new ExceptionFactory($exception))->create();
        }
    }
}
