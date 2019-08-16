<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Services\Webhooks\Interfaces;

use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Interface for a parser that turns webhook requests in to usable objects.
 */
interface ParserInterface
{
    /**
     * Attempts to parse the provided request data in to the entity identified by the provided class name.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @param string $className
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function toObject(RequestInterface $request, string $className): EntityInterface;
}
