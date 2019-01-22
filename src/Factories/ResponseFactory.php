<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Factories;

use EoneoPay\PhpSdk\Exceptions\InvalidResponseClass;
use EoneoPay\PhpSdk\Exceptions\InvalidResponseContentType;
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
     * @param string|null $data
     *
     * @return \EoneoPay\PhpSdk\Responses\AbstractResponse returns the object of the expected class.
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\InvalidResponseClass
     * @throws \EoneoPay\PhpSdk\Exceptions\InvalidResponseContentType
     */
    public function create(string $responseClass, ?string $data = null): AbstractResponse
    {
        $response = $this->serializer->deserialize($data, $responseClass, $this->guessContentType($data ?? ''));

        if ($response instanceof AbstractResponse) {
            return $response;
        }

        // sanity check, the serializer will throw an exception before this is reached
        // @codeCoverageIgnoreStart
        throw new InvalidResponseClass('Class specified does not derive from a response');
        // @codeCoverageIgnoreEnd
    }

    /**
     * Guess content-type from
     *
     * @param string $data
     *
     * @return string
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\InvalidResponseContentType
     */
    private function guessContentType(string $data): string
    {
        \json_decode($data);

        if (\json_last_error() === \JSON_ERROR_NONE) {
            return self::TYPE_JSON;
        }

        throw new InvalidResponseContentType('Expected JSON content type');
    }
}
