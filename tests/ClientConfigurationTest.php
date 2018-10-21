<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\ClientConfiguration;

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
        $config = new ClientConfiguration('api-key', 'https://api.test.com');

        self::assertSame('api-key', $config->getApiKey());
        self::assertSame('https://api.test.com', $config->getBaseUri());
    }
}
