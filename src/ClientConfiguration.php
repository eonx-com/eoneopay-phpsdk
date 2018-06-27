<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Interfaces\ClientConfigurationInterface;

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
     * ClientConfiguration constructor.
     *
     * @param string $apiKey
     * @param string $baseUri
     */
    public function __construct(string $apiKey, string $baseUri)
    {
        $this->apiKey = $apiKey;
        $this->baseUri = $baseUri;
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
}
