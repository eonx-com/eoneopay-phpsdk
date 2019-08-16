<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Services\Webhooks;

use EoneoPay\PhpSdk\Services\Webhooks\Exceptions\DeserializedObjectNotEntityException;
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
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\DeserializedObjectNotEntityException
     * @throws \ReflectionException
     */
    public function toObject(RequestInterface $request, string $className): EntityInterface
    {
        // Ensure that the provided class name exists and that it implements EntityInterface
        if (\class_exists($className) === false ||
            \in_array(EntityInterface::class, (new \ReflectionClass($className))->getInterfaceNames(), true) === false
        ) {
            throw new InvalidEntityClassException($className);
        }

        // Get the serializer instance
        $serializer = $this->serializerFactory->create();

        // Get the request body content
        $body = $request->getBody();
        $content = $body->getContents();

        // Attempt to deserialize the JSON in to an object
        $instance = $serializer->deserialize($content, $className, 'json');

        // @codeCoverageIgnoreStart
        // Sanity check, unable to test as the passed class is checked for EntityInterface above
        if (($instance instanceof EntityInterface) === false) {
            throw new DeserializedObjectNotEntityException($instance);
        }

        // @codeCoverageIgnoreEnd

        return $instance;
    }
}
