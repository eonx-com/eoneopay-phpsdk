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
     * @param string $className The full class name to parse the content in to.
     * @param string $content The content to parse.
     * @param string $contentType The type of the content (i.e. 'json', or 'xml')
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function parse(string $className, string $content, string $contentType): EntityInterface;

    /**
     * Attempts to parse the provided request data in to the entity identified by the provided class name.
     *
     * @param string $className
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function parseRequest(string $className, RequestInterface $request): EntityInterface;
}
