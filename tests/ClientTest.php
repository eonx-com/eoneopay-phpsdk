<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Client;
use EoneoPay\PhpSdk\ClientConfiguration;
use Tests\EoneoPay\PhpSdk\TestCases\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Client
 */
class ClientTest extends TestCase
{
    /**
     * Test client object functionality.
     *
     * @return void
     */
    public function testObjectFunctionality(): void
    {
        $client = new Client(
            new ClientConfiguration('api-key', 'https://api.test.com')
        );

        self::assertInstanceOf(Client::class, $client);
    }
}
