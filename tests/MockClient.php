<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use LoyaltyCorp\SdkBlueprint\Sdk\Client as BaseClient;

class MockClient extends BaseClient
{
    /**
     * Construct mock HTTP client.
     *
     * @param mixed[] $content
     * @param int|null $responseCode
     * @param mixed[]|null $header
     */
    public function __construct(array $content, ?int $responseCode = null, ?array $header = null)
    {
        $header = $header ?? [];
        $responseCode = $responseCode ?? 200;

        $handler = new MockHandler([
            new Response($responseCode, $header, \json_encode($content))
        ]);

        parent::__construct(new GuzzleClient([
            'handler' => $handler
        ]));
    }
}
