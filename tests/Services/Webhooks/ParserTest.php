<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Services\Webhooks;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
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
class ParserTest extends TestCase
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
                <<<JSON
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
            )
        ];

        yield 'Token Revocation' => [
            PaymentSource::class,
            new Request(
                'POST',
                '/listen/eoneopay/token_revoke',
                [],
                <<<JSON
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
            )
        ];
    }

    /**
     * Tests that the 'toObject' method successfully converts the provided JSON from a
     * token revocation webhook request, in to a typed object (of type BankAccount).
     *
     * @param string $targetClass
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\DeserializedObjectNotEntityException
     * @throws \ReflectionException
     *
     * @dataProvider getWebhookTestRequests
     */
    public function testToObjectSuccessful(string $targetClass, RequestInterface $request): void
    {
        $serializerFactory = new SerializerFactory();
        $parser = $this->getInstance($serializerFactory);

        $result = $parser->toObject($request, $targetClass);

        self::assertNotNull($result);
    }

    /**
     * Tests that the 'toObject' method throws an exception when the provided class name is not
     * that of a class which implements EntityInterface.
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\DeserializedObjectNotEntityException
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
     * @throws \ReflectionException
     */
    public function testToObjectThrowsExceptionOnNonEntityClass(): void
    {
        $this->expectException(InvalidEntityClassException::class);

        $serializerFactory = new SerializerFactory();
        $parser = $this->getInstance($serializerFactory);

        $parser->toObject(
            new Request('get', '/'),
            __CLASS__
        );
    }

    /**
     * Tests that the 'toObject' method throws an exception when the provided class does not exist.
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\DeserializedObjectNotEntityException
     * @throws \EoneoPay\PhpSdk\Services\Webhooks\Exceptions\InvalidEntityClassException
     * @throws \ReflectionException
     */
    public function testToObjectThrowsExceptionOnNonExistentClass(): void
    {
        $this->expectException(InvalidEntityClassException::class);

        $serializerFactory = new SerializerFactory();
        $parser = $this->getInstance($serializerFactory);

        $parser->toObject(
            new Request('get', '/'),
            'NotARealClass'
        );
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
