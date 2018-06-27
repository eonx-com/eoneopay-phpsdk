<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Interfaces\ClientConfigurationInterface;
use GuzzleHttp\Client as GuzzleClient;
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
        parent::__construct(new GuzzleClient([
            'auth' => [$configuration->getApiKey(), null],
            'base_uri' => $configuration->getBaseUri()
        ]));
    }

}
