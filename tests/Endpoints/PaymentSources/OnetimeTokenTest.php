<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\V1\PaymentSources\BankAccount;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSource
 * @covers \EoneoPay\PhpSdk\Endpoints\V1\PaymentSources\BankAccount
 */
class OnetimeTokenTest extends TestCase
{
    /**
     * Test one time token creation.
     *
     * @return void
     *
     * @throws \JsonException
     */
    public function testOneTimeTokenCreation(): void
    {
        $response = <<<JSON
{
    "country": "AU",
    "created_at": "2020-05-08T02:35:42Z",
    "currency": "AUD",
    "id": "2b0068358e34a974e11094a4b32d9b08",
    "name": "User Name",
    "number": "987654321",
    "one_time": true,
    "pan": "123-456...4321",
    "prefix": "123-456",
    "token": "VC2ANGBD7XM6UTZPA327",
    "type": "bank_account",
    "updated_at": "2020-05-08T02:35:42Z",
    "user": null
}
JSON;

        $request = new BankAccount([
            'country' => 'AU',
            'name' => 'User Name',
            'number' => '987654321',
            'prefix' => '123456'
        ], true);

        /**
         * @var \EoneoPay\PhpSdk\Endpoints\V1\PaymentSources\BankAccount $token
         */
        $token = $this->createApiManager(
            \json_decode($response, true, 512, \JSON_THROW_ON_ERROR)
        )->create('user-api-key', $request);

        // assert getters
        self::assertSame('2b0068358e34a974e11094a4b32d9b08', $token->getId());
        self::assertSame('2020-05-08T02:35:42Z', $token->getUpdatedAt());
        self::assertSame('2020-05-08T02:35:42Z', $token->getCreatedAt());
        self::assertSame('User Name', $token->getName());
        self::assertSame('123-456...4321', $token->getPan());
        self::assertSame('VC2ANGBD7XM6UTZPA327', $token->getToken());
        self::assertSame('bank_account', $token->getType());
        self::assertTrue($token->isOneTime());
    }

    /**
     * Tests uris.
     *
     * @return void
     */
    public function testUris(): void
    {
        $token = new BankAccount([], true);

        $expected = [
            'create' => '/tokens/onetime',
            'delete' => '/tokens/',
            'get' => '/tokens/'
        ];
        self::assertSame($expected, $token->uris());
    }
}
