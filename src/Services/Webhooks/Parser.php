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
     * {@inheritdoc}
     *
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
     */
    public function parse(string $className, string $content, string $contentType): EntityInterface
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
    public function parseRequest(string $className, RequestInterface $request): EntityInterface
    {
        $content = $request->getBody()->getContents();

        return $this->parse($className, $content, 'json');
    }
}
