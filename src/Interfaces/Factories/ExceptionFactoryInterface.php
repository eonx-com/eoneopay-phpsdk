<?php
/**
 * Created by PhpStorm.
 * User: Codeint
 * Date: 26/02/2019
 * Time: 09:18
 */

namespace EoneoPay\PhpSdk\Interfaces\Factories;

use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException;

interface ExceptionFactoryInterface
{
    /**
     * Create exception object based on error code range.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException $exception
     *
     * @return \EoneoPay\Utils\Exceptions\BaseException
     */
    public function create(InvalidApiResponseException $exception): Exception;
}
