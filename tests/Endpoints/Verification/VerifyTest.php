<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Verification;

use EoneoPay\PhpSdk\Endpoints\Tokens\NominalToken;
use EoneoPay\PhpSdk\Endpoints\Verification\Verify;
use Tests\EoneoPay\PhpSdk\TestCases\ValidationEnabledTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Verification\Verify
 */
class VerifyTest extends ValidationEnabledTestCase
{
    /**
     * Test getters on verification verify.
     *
     * @return void
     */
    public function testGetters(): void
    {
        $verify = new Verify([
            'amount' => '0.05',
            'token' => new NominalToken(['token' => 'TEST_TOKEN'])
        ]);
        $expectedUris = [
            'create' => '/nominal/verify/TEST_TOKEN'
        ];

        static::assertSame('0.05', $verify->getAmount());
        static::assertSame('TEST_TOKEN', $verify->getToken()->getToken());
        static::assertSame($expectedUris, $verify->uris());
    }

    /**
     * Test that validating sdk endpoint returns expected errors.
     *
     * @return void
     */
    public function testValidationErrors(): void
    {
        $verify = new Verify();
        $validator = $this->getValidator();

        $expectedErrors = <<<'ERR'
Object(EoneoPay\PhpSdk\Endpoints\Verification\Verify).amount:
    This value should not be blank. (code c1051bb4-d103-4f74-8988-acbcafc7fdc3)
Object(EoneoPay\PhpSdk\Endpoints\Verification\Verify).token:
    This value should not be blank. (code c1051bb4-d103-4f74-8988-acbcafc7fdc3)

ERR;

        $result = $validator->validate($verify);

        $this->assertConstraints($expectedErrors, $result);
    }

    /**
     * Test verify nominal verification.
     *
     * @return void
     */
    public function testVerifyNominalVerification(): void
    {
        $verify = new Verify([
            'amount' => '0.05',
            'token' => new NominalToken(['token' => 'TEST_TOKEN'])
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
        "nominal_status": 3,
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
            'nominal_status' => 3,
            'one_time' => false,
            'token' => '4RMMVVWCJXKH4Z6ECWP0',
            'type' => 'bank_account'
        ]);

        $manager = $this->createApiManager(
            \json_decode($response, true, 512, \JSON_THROW_ON_ERROR),
            200
        );

        $result = $manager->create('TEST_API_KEY', $verify);

        self::assertInstanceOf(Verify::class, $result);
        self::assertEquals($expected, $result->getToken());
    }
}
