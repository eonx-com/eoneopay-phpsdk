<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\ClientConfiguration;
use GuzzleHttp\Handler\MockHandler;
use Tests\EoneoPay\PhpSdk\TestCases\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\ClientConfiguration
 */
class ClientConfigurationTest extends TestCase
{
    /**
     * Test config object functionality.
     *
     * @return void
     */
    public function testObjectFunctionality(): void
    {
        $handler = new MockHandler([]);

        $config = new ClientConfiguration('api-key', 'https://api.test.com', $handler);

        self::assertSame('api-key', $config->getApiKey());
        self::assertSame('https://api.test.com', $config->getBaseUri());
        self::assertSame($handler, $config->getHandler());
    }
}
