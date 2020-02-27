<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Verification;

use EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount;
use EoneoPay\PhpSdk\Endpoints\Tokens\NominalToken;
use EoneoPay\PhpSdk\Endpoints\Verification\Initiate;
use EoneoPay\PhpSdk\Exceptions\ClientException;
use Tests\EoneoPay\PhpSdk\TestCases\ValidationEnabledTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Verification\Initiate
 */
class InitiateTest extends ValidationEnabledTestCase
{
    /**
     * Test getters on verification initiate.
     *
     * @return void
     */
    public function testGetters(): void
    {
        $initiate = new Initiate([
            'token' => new NominalToken(['token' => 'TEST_TOKEN'])
        ]);
        $expectedUris = [
            'create' => '/nominal/initiate/TEST_TOKEN'
        ];

        static::assertSame('TEST_TOKEN', $initiate->getToken()->getToken());
        static::assertSame($expectedUris, $initiate->uris());
    }

    /**
     * Test initiate nominal verification.
     *
     * @return void
     */
    public function testInitiateNominalVerification(): void
    {
        $initiate = new Initiate([
            'token' => new NominalToken([
                'token' => '4RMMVVWCJXKH4Z6ECWP0'
            ])
        ]);

        $response = <<<JSON
{
    "token": {
        "authority_agreement": {
            "last_agreed": null,
            "version": null
        },
        "country": "AU",
        "created_at": "2020-02-20T21:45:07Z",
        "currency": "AUD",
        "id": "2b0068358e34a974e11094a4b32d9b08",
        "name": "User Name",
        "nominal_status": 1,
        "number": "987654321",
        "one_time": false,
        "pan": "123-456...4321",
        "prefix": "123-456",
        "token": "4RMMVVWCJXKH4Z6ECWP0",
        "type": "bank_account",
        "updated_at": "2020-02-20T21:45:07Z",
        "user": {
            "created_at": "2020-02-20T21:43:17Z",
            "email": "sub-user@example.com",
            "metadata": [],
            "name": null,
            "updated_at": "2020-02-20T21:43:17Z"
        }
    }
}
JSON;

        $expected = new NominalToken([
            'country' => 'AU',
            'name' => 'User Name',
            'nominal_status' => 1,
            'one_time' => false,
            'token' => '4RMMVVWCJXKH4Z6ECWP0',
            'type' => 'bank_account'
        ]);

        $manager = $this->createApiManager(
            \json_decode($response, true, 512, \JSON_THROW_ON_ERROR),
            201
        );

        $result = $manager->create('API-KEY', $initiate);

        self::assertInstanceOf(Initiate::class, $result);
        self::assertEquals($expected, $result->getToken());
    }

    /**
     * Test initiating an invalid token.
     *
     * @return void
     */
    public function testInitiateOnInvalidToken(): void
    {
        $initiate = new Initiate([
            'token' => new NominalToken([
                'token' => '4RMMVVWCJXKH4Z6ECWP0'
            ])
        ]);

        $response = <<<JSON
{
    "code": 4220,
    "message": "Token provided is invalid or could not be found.",
    "sub_code": 2,
    "time": "2020-02-27T01:16:50Z"
}
JSON;
        $manager = $this->createApiManager(
            \json_decode($response, true, 512, \JSON_THROW_ON_ERROR),
            404
        );

        $this->expectException(ClientException::class);
        $this->expectExceptionMessage('Token provided is invalid or could not be found.');
        $this->expectExceptionCode(4220);

        $manager->create('API-KEY', $initiate);
    }

    /**
     * Test that validating sdk endpoint returns expected errors.
     *
     * @return void
     */
    public function testValidateTokenIsObject(): void
    {
        $initiate = new Initiate(['token' => new BankAccount()]);
        $validator = $this->getValidator();

        //phpcs:disable
        $expectedErrors = <<<'ERR'
Object(EoneoPay\PhpSdk\Endpoints\Verification\Initiate).token:
    This value should be of type EoneoPay\PhpSdk\Endpoints\Tokens\NominalToken. (code ba785a8c-82cb-4283-967c-3cf342181b40)

ERR;
        //phpcs:enable

        $result = $validator->validate($initiate);

        $this->assertConstraints($expectedErrors, $result);
    }

    /**
     * Test that validating sdk endpoint returns expected errors.
     *
     * @return void
     */
    public function testValidationErrors(): void
    {
        $initiate = new Initiate();
        $validator = $this->getValidator();

        $expectedErrors = <<<'ERR'
Object(EoneoPay\PhpSdk\Endpoints\Verification\Initiate).token:
    This value should not be blank. (code c1051bb4-d103-4f74-8988-acbcafc7fdc3)

ERR;

        $result = $validator->validate($initiate);

        $this->assertConstraints($expectedErrors, $result);
    }
}
