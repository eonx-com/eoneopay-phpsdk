<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Services\Webhooks;

use EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException;
use EoneoPay\PhpSdk\Services\Webhooks\Interfaces\ParserInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\Factories\SerializerFactoryInterface;
use Psr\Http\Message\RequestInterface;

class Parser implements ParserInterface
{
    /**
     * @var \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\Factories\SerializerFactoryInterface
     */
    private $serializerFactory;

    /**
     * Constructs a new instance of Parser.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\Factories\SerializerFactoryInterface $serializerFactory
     */
    public function __construct(
        SerializerFactoryInterface $serializerFactory
    ) {
        $this->serializerFactory = $serializerFactory;
    }

    /**
     * Attempts to aprse the provided content in to the entity identified by the provided class name.
     *
     * @param string $content The content to parse.
     * @param string $contentType The type of the content (i.e. 'json', or 'xml')
     * @param string $className The full class name to parse the content in to.
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     *
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
     */
    public function parse(string $content, string $contentType, string $className): EntityInterface
    {
        // Get the serializer instance
        $serializer = $this->serializerFactory->create();

        // Attempt to deserialize the JSON in to an object
        $instance = $serializer->deserialize($content, $className, $contentType);

        // Ensure the parsed instance implements EntityInterface
        if (($instance instanceof EntityInterface) === false) {
            throw new InvalidEntityClassException($className);
        }

        return $instance;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
     */
    public function parseRequest(RequestInterface $request, string $className): EntityInterface
    {
        $content = $request->getBody()->getContents();

        return $this->parse($content, 'json', $className);
    }
}
