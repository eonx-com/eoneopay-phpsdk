<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Client;
use EoneoPay\PhpSdk\ClientConfiguration;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Tests\EoneoPay\PhpSdk\TestCases\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Client
 */
class ClientTest extends TestCase
{
    /**
     * Test mock handler functionality
     *
     * @return void
     *
     * @throws \EoneoPay\Externals\HttpClient\Exceptions\InvalidApiResponseException If response isn't successful
     */
    public function testMockHandlerFunctionality(): void
    {
        $response = new Response(200, [], 'mock body');

        $client = new Client(new ClientConfiguration('api-key', 'https://api.test.com', new MockHandler([$response])));

        self::assertSame('mock body', $client->request('get', 'test')->getContent());
    }

    /**
     * Test client object functionality.
     *
     * @return void
     */
    public function testObjectFunctionality(): void
    {
        $client = new Client(new ClientConfiguration('api-key', 'https://api.test.com'));

        self::assertInstanceOf(Client::class, $client);
    }
}
