<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Services\Webhooks;

use EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException;
use EoneoPay\PhpSdk\Services\Webhooks\Exceptions\WebhookParserValidationException;
use EoneoPay\PhpSdk\Services\Webhooks\Interfaces\ParserInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class Parser implements ParserInterface
{
    /**
     * The serializer instance.
     *
     * @var \Symfony\Component\Serializer\SerializerInterface
     */
    private $serializer;

    /**
     * The validator instance.
     *
     * @var \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    private $validator;

    /**
     * Constructs a new instance of Parser.
     *
     * @param \Symfony\Component\Serializer\SerializerInterface $serializer
     * @param \Symfony\Component\Validator\Validator\ValidatorInterface $validator
     */
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\WebhookParserValidationException
     */
    public function parse(
        string $className,
        string $content,
        string $contentType,
        ?array $serializerOptions = null
    ): EntityInterface {
        // Attempt to deserialize the JSON in to an object
        $instance = $this->serializer->deserialize(
            $content,
            $className,
            $contentType,
            $serializerOptions ?? []
        );

        // Ensure the parsed instance implements EntityInterface
        if (($instance instanceof EntityInterface) === false) {
            throw new InvalidEntityClassException($className);
        }

        /**
         * @var \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $instance
         *
         * @see https://youtrack.jetbrains.com/issue/WI-37859 - typehint required until PhpStorm recognises === check
         */

        // Validate the entity
        $result = $this->validator->validate($instance);
        if ($result->count() > 0) {
            throw new WebhookParserValidationException($result);
        }

        return $instance;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\WebhookParserValidationException
     */
    public function parseRequest(
        string $className,
        RequestInterface $request,
        ?array $serializerOptions = null
    ): EntityInterface {
        $content = $request->getBody()->getContents();

        return $this->parse($className, $content, 'json', $serializerOptions);
    }
}
