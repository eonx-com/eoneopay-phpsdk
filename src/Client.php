<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Interfaces\ClientConfigurationInterface;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\MockHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Client as BaseClient;

class Client extends BaseClient
{
    /**
     * Client constructor.
     *
     * @param \EoneoPay\PhpSdk\Interfaces\ClientConfigurationInterface $configuration
     */
    public function __construct(ClientConfigurationInterface $configuration)
    {
        $options = [
            'auth' => [$configuration->getApiKey(), null],
            'base_uri' => $configuration->getBaseUri()
        ];

        // Only add handler if provided
        if ($configuration->getHandler() instanceof MockHandler) {
            $options['handler'] = $configuration->getHandler();
        }

        parent::__construct(new Guzzle($options));
    }
}
