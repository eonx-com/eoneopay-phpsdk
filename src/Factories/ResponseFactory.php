<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Factories;

use EoneoPay\PhpSdk\Exceptions\InvalidResponseClass;
use EoneoPay\PhpSdk\Responses\AbstractResponse;
use LoyaltyCorp\SdkBlueprint\Sdk\SerializerFactory;

class ResponseFactory
{
    /**
     * Type string representation for JSON content type
     *
     * @const string
     */
    private const TYPE_JSON = 'json';

    /**
     * The Serializer instance.
     *
     * @var \Symfony\Component\Serializer\Serializer
     */
    private $serializer;

    /**
     * ResponseFactory constructor.
     */
    public function __construct()
    {
        $this->serializer = (new SerializerFactory())->create();
    }

    /**
     * Instantiate a populated response object.
     *
     * @param string $responseClass
     * @param mixed[]|null $data
     *
     * @return \EoneoPay\PhpSdk\Responses\AbstractResponse returns the object of the expected class.
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\InvalidResponseClass
     */
    public function create(string $responseClass, ?array $data = null): AbstractResponse
    {
        $response = $this->serializer->denormalize($data, $responseClass);

        if ($response instanceof AbstractResponse) {
            return $response;
        }

        // sanity check, the serializer will throw an exception before this is reached
        // @codeCoverageIgnoreStart
        throw new InvalidResponseClass('Class specified does not derive from a response');
        // @codeCoverageIgnoreEnd
    }
}
