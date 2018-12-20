<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Interfaces\ClientConfigurationInterface;
use GuzzleHttp\Handler\MockHandler;

class ClientConfiguration implements ClientConfigurationInterface
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var \GuzzleHttp\Handler\MockHandler|null
     */
    private $handler;

    /**
     * ClientConfiguration constructor.
     *
     * @param string $apiKey
     * @param string $baseUri
     * @param \GuzzleHttp\Handler\MockHandler|null $handler
     */
    public function __construct(string $apiKey, string $baseUri, ?MockHandler $handler = null)
    {
        $this->apiKey = $apiKey;
        $this->baseUri = $baseUri;
        $this->handler = $handler;
    }

    /**
     * Get API key.
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Get base uri.
     *
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @inheritdoc
     */
    public function getHandler(): ?MockHandler
    {
        return $this->handler;
    }
}
