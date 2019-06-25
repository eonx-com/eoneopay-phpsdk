<?php
declare(strict_types=1);

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
     * @return \Exception
     */
    public function create(InvalidApiResponseException $exception): Exception;
}
