<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Factories;

use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use EoneoPay\PhpSdk\Interfaces\Factories\EoneoPayApiManagerFactoryInterface;
use EoneoPay\PhpSdk\Managers\EoneoPayApiManager;
use GuzzleHttp\Client as GuzzleClient;
use LoyaltyCorp\SdkBlueprint\Sdk\Factories\SerializerFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Factories\UrnFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Handlers\RequestHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Handlers\ResponseHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\SdkManagerInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Managers\SdkManager;

final class EoneoPayApiManagerFactory implements EoneoPayApiManagerFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(string $baseUri, ?array $headers = null): EoneoPayApiManagerInterface
    {
        return new EoneoPayApiManager(
            $this->createSdkManager($baseUri, $headers),
            new ExceptionFactory()
        );
    }

    /**
     * Create sdk manager instance.
     *
     * @param string $baseUri Api base uri
     * @param mixed[] $headers Headers to send with request
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\SdkManagerInterface
     */
    private function createSdkManager(string $baseUri, ?array $headers = null): SdkManagerInterface
    {
        $options = \is_array($headers) === true ?
            ['base_uri' => $baseUri, 'headers' => $headers] :
            ['base_uri' => $baseUri];

        return new SdkManager(
            new RequestHandler(
                new GuzzleClient($options),
                new ResponseHandler(),
                new SerializerFactory(),
                new UrnFactory()
            )
        );
    }
}
