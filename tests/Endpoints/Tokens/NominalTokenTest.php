<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Tokens;

use EoneoPay\PhpSdk\Endpoints\Tokens\NominalToken;
use Tests\EoneoPay\PhpSdk\TestCases\ValidationEnabledTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Tokens\NominalToken
 */
class NominalTokenTest extends ValidationEnabledTestCase
{
    /**
     * Tests construction and getters on endpoint token.
     *
     * @return void
     */
    public function testConstructionAndGetters(): void
    {
        $endpointToken = new NominalToken([
            'country' => 'AU',
            'name' => 'User Name',
            'nominal_status' => 1,
            'one_time' => true,
            'token' => '4RMMVVWCJXKH4Z6ECWP0',
            'type' => 'bank_account'
        ]);

        self::assertSame('AU', $endpointToken->getCountry());
        self::assertSame('User Name', $endpointToken->getName());
        self::assertSame(1, $endpointToken->getNominalStatus());
        self::assertTrue($endpointToken->isOneTime());
        self::assertSame('4RMMVVWCJXKH4Z6ECWP0', $endpointToken->getToken());
        self::assertSame('bank_account', $endpointToken->getType());
    }

    /**
     * Tests that no uri's have been defined.
     *
     * @return void
     */
    public function testUris(): void
    {
        $endpointToken = new NominalToken();

        $uris = $endpointToken->uris();

        self::assertSame([], $uris);
    }

    /**
     * Test validation on token properties.
     *
     * @return void
     */
    public function testValidationErrors(): void
    {
        $token = new NominalToken();
        $validator = $this->getValidator();

        $expectedErrors = <<<'ERR'
Object(EoneoPay\PhpSdk\Endpoints\Tokens\NominalToken).token:
    This value should not be blank. (code c1051bb4-d103-4f74-8988-acbcafc7fdc3)

ERR;

        $result = $validator->validate($token);

        $this->assertConstraints($expectedErrors, $result);
    }
}
