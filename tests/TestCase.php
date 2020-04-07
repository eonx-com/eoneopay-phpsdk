<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Factories\ExceptionFactory;
use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use EoneoPay\PhpSdk\Managers\EoneoPayApiManager;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use LoyaltyCorp\SdkBlueprint\Sdk\Factories\SerializerFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Factories\UrnFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Handlers\RequestHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Handlers\ResponseHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Managers\SdkManager;
use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * @coversNothing
 *
 * @SuppressWarnings(PHPMD.NumberOfChildren) All tests extend this class
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects) High coupling required to fully test.
 */
abstract class TestCase extends BaseTestCase
{
    /**
     * Create api manager instnace.
     *
     * @param mixed[]|null $body
     * @param int|null $responseCode
     *
     * @return \EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface
     */
    protected function createApiManager(?array $body = null, ?int $responseCode = null): EoneoPayApiManagerInterface
    {
        $client = \is_array($body) === true || \is_int($responseCode) === true
            ? $this->createClient($body, $responseCode)
            : $this->createLiveClient();

        return new EoneoPayApiManager(
            new SdkManager(
                new RequestHandler(
                    $client,
                    new ResponseHandler(),
                    new SerializerFactory(),
                    new UrnFactory()
                )
            ),
            new ExceptionFactory()
        );
    }

    /**
     * Generate a unique id with an optional prefix.
     *
     * @param string|null $prefix The prefix to use when generating the id
     *
     * @return string
     */
    protected function generateId(?string $prefix = null): string
    {
        /** @noinspection ArgumentEqualsDefaultValueInspection EA inspections require both parameters to be passed */
        return \uniqid($prefix ?? '', false);
    }

    /**
     * Create body.
     *
     * @param mixed[] $body
     *
     * @return string
     */
    private function createBody(?array $body): string
    {
        $enBody = \json_encode($body ?? []);

        return ($enBody === false) ? '' : $enBody;
    }

    /**
     * Get http client with mock handler.
     *
     * @param mixed[]|null $body
     * @param int|null $responseCode
     *
     * @return \GuzzleHttp\ClientInterface
     */
    private function createClient(?array $body = null, ?int $responseCode = null): ClientInterface
    {
        return new Client([
            'handler' => new MockHandler([
                new Response(
                    $responseCode ?? 200,
                    ['Accept' => 'application/json', 'Content-Type' => 'application/json'],
                    $this->createBody($body)
                ),
            ]),
        ]);
    }

    /**
     * Create live http client.
     *
     * @return \GuzzleHttp\ClientInterface
     */
    private function createLiveClient(): ClientInterface
    {
        return new Client([
            'base_uri' => (string)\getenv('PAYMENTS_BASE_URI'),
            'headers' => ['Accept' => 'application/vnd.eoneopay.v2+json']
        ]);
    }
}
