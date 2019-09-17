<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Services\Webhooks;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount;
use EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException;
use EoneoPay\PhpSdk\Services\Webhooks\Parser;
use GuzzleHttp\Psr7\Request;
use LoyaltyCorp\SdkBlueprint\Sdk\Factories\SerializerFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\Factories\SerializerFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Services\Webhooks\Parser
 */
final class ParserTest extends TestCase
{
    /**
     * Gets various test webhook requests to ensure successfull parsing.
     *
     * @return mixed[]
     */
    public function getWebhookTestRequests(): iterable
    {
        yield 'Token Added' => [
            PaymentSource::class,
            new Request(
                'POST',
                '/listen/eoneopay/token',
                [],
                <<<'JSON'
{
    "country": "AU",
    "created_at": "2019-07-31T06:08:07Z",
    "currency": "AUD",
    "customer": {"email": "example@example.com"},
    "id": "cc0a468f1fb821f457977d8f6b7f3f63",
    "name": "User Name",
    "number": "987654321",
    "one_time": false,
    "pan": "123-456...4321",
    "prefix": "123-456",
    "token": "RPW2NYUJCGHFJ72WTDZ1",
    "type": "bank_account",
    "updated_at": "2019-07-31T06:08:07Z"
}
JSON
            ),
        ];

        yield 'Token Revocation' => [
            PaymentSource::class,
            new Request(
                'POST',
                '/listen/eoneopay/token_revoke',
                [],
                <<<'JSON'
{
    "country": "AU",
    "created_at": "2019-07-31T06:08:07Z",
    "currency": "AUD",
    "customer": {"email": "customer@example.com"},
    "id": "cc0a468f1fb821f457977d8f6b7f3f63",
    "name": "User Name",
    "number": "987654321",
    "one_time": false,
    "pan": "123-456...4321",
    "prefix": "123-456",
    "token": "FDJ9934242YBP3C2ZC43",
    "type": "bank_account",
    "updated_at": "2019-07-31T06:08:07Z"
}
JSON
            ),
        ];
    }

    /**
     * Tests that the 'parseRequest' method accepts a Request instance and returns an instance of the provided
     * $targetClass class name.
     *
     * @param string $targetClass
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
     *
     * @dataProvider getWebhookTestRequests
     */
    public function testParseRequestSuccessful(string $targetClass, RequestInterface $request): void
    {
        $parser = $this->getInstance();

        $result = $parser->parseRequest($targetClass, $request);

        // @todo: SerializerFactory and Seralizer need to be stubbed so that we can assert the parser result.
        // @see: https://loyaltycorp.atlassian.net/browse/PYMT-1222
        /** @noinspection UnnecessaryAssertionInspection Testing concrete implementation passed by data provider */
        self::assertInstanceOf($targetClass, $result);
    }

    /**
     * Tests that the 'parse' method successfully converts the provided JSON to a typed object.
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
     */
    public function testParseSuccessful(): void
    {
        $serializerFactory = new SerializerFactory();
        $parser = $this->getInstance($serializerFactory);
        $json = <<<'JSON'
{
    "country": "AU",
    "created_at": "2019-07-31T06:08:07Z",
    "currency": "AUD",
    "customer": {"email": "customer@example.com"},
    "id": "cc0a468f1fb821f457977d8f6b7f3f63",
    "name": "User Name",
    "number": "987654321",
    "one_time": false,
    "pan": "123-456...4321",
    "prefix": "123-456",
    "token": "FDJ9934242YBP3C2ZC43",
    "type": "bank_account",
    "updated_at": "2019-07-31T06:08:07Z"
}
JSON;
        $expected = new BankAccount([
            'country' => 'AU',
            'createdAt' => '2019-07-31T06:08:07Z',
            'currency' => 'AUD',
            'id' => 'cc0a468f1fb821f457977d8f6b7f3f63',
            'name' => 'User Name',
            'number' => '987654321',
            'oneTime' => false,
            'pan' => '123-456...4321',
            'prefix' => '123-456',
            'token' => 'FDJ9934242YBP3C2ZC43',
            'type' => 'bank_account',
            'updatedAt' => '2019-07-31T06:08:07Z',
        ]);

        $result = $parser->parse(BankAccount::class, $json, 'json');

        /** @var \EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount $result */
        self::assertInstanceOf(BankAccount::class, $result);
        self::assertEquals($expected, $result);
    }

    /**
     * Tests that the 'parse' method throws an exception when the provided class name is not
     * that of a class which implements EntityInterface.
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
     */
    public function testParseThrowsExceptionOnNonEntityClass(): void
    {
        $this->expectException(InvalidEntityClassException::class);

        $parser = $this->getInstance();

        $parser->parse(\stdClass::class, '{}', 'json');
    }

    /**
     * Gets an instance of the parser.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\Factories\SerializerFactoryInterface|null $serializerFactory
     *
     * @return \EoneoPay\PhpSdk\Services\Webhooks\Parser
     */
    private function getInstance(?SerializerFactoryInterface $serializerFactory = null): Parser
    {
        return new Parser(
            $serializerFactory ?? new SerializerFactory()
        );
    }
}
