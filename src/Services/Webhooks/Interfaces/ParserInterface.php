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
     * Attempts to aprse the provided content in to the entity identified by the provided class name.
     *
     * @param string $content The content to parse.
     * @param string $contentType The type of the content (i.e. 'json', or 'xml')
     * @param string $className The full class name to parse the content in to.
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function parse(string $content, string $contentType, string $className): EntityInterface;

    /**
     * Attempts to parse the provided request data in to the entity identified by the provided class name.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @param string $className
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function parseRequest(RequestInterface $request, string $className): EntityInterface;
}
