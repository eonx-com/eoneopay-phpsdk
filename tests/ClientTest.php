<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Client;
use EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException;
use EoneoPay\PhpSdk\Interfaces\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Tests\EoneoPay\PhpSdk\Stubs\AllActionRequestStub;
use Tests\EoneoPay\PhpSdk\TestCases\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Client
 */
class ClientTest extends TestCase
{
    /**
     * Test excepiton is thrown if client is not configured
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException If no base uri or handler has been set
     */
    public function testExceptionThrownIfClientNotConfigured(): void
    {
        $this->expectException(ClientNotConfiguredException::class);
        $this->expectExceptionMessage('No base uri or handler set, can not continue');

        (new Client())->get(new AllActionRequestStub());
    }

    /**
     * Test mock handler functionality
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException If no base uri or handler has been set
     */
    public function testMockHandlerFunctionality(): void
    {
        $response = new Response(200, [], \json_encode(['id' => 'mock body']));

        $client = new Client();
        $client->setHandler(new MockHandler([$response]));

        self::assertSame('mock body', $client->get(new AllActionRequestStub())->getId());
    }

    /**
     * Test each request method
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException If no base uri or handler has been set
     */
    public function testRequestMethod(): void
    {
        $responses = [
            new Response(200, [], \json_encode(['id' => 'create'])),
            new Response(200, [], \json_encode(['id' => 'delete'])),
            new Response(200, [], \json_encode(['id' => 'get'])),
            new Response(200, [], \json_encode(['id' => 'list'])),
            new Response(200, [], \json_encode(['id' => 'update']))
        ];

        $client = new Client();
        $client->setHandler(new MockHandler($responses));

        self::assertSame('create', $client->create(new AllActionRequestStub())->getId());
        self::assertSame('delete', $client->delete(new AllActionRequestStub())->getId());
        self::assertSame('get', $client->get(new AllActionRequestStub())->getId());
        self::assertCount(1, $client->list(new AllActionRequestStub()));
        self::assertSame('update', $client->update(new AllActionRequestStub())->getId());
    }

    /**
     * Test setters
     *
     * @return void
     */
    public function testSettersReturnStatic(): void
    {
        $client = new Client();

        self::assertInstanceOf(ClientInterface::class, $client->setApiKey('APIKEY'));
        self::assertInstanceOf(ClientInterface::class, $client->setBaseUri('http://localhost'));
        self::assertInstanceOf(ClientInterface::class, $client->setHandler(new MockHandler()));
    }
}
