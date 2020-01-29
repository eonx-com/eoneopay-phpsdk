<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Verification;

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
            'token' => 'TEST_TOKEN'
        ]);
        $expectedUris = [
            'create' => '/verify/TEST_TOKEN'
        ];

        static::assertSame('0.05', $verify->getAmount());
        static::assertSame('TEST_TOKEN', $verify->getToken());
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
            'token' => 'TEST_TOKEN'
        ]);

        $manager = $this->createApiManager(null, 200);

        $result = $manager->create('TEST_API_KEY', $verify);

        self::assertInstanceOf(Verify::class, $result);
    }
}
