<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Verification;

use EoneoPay\PhpSdk\Endpoints\Verification\Initiate;
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
            'token' => 'TEST_TOKEN'
        ]);
        $expectedUris = [
            'create' => '/initiate/TEST_TOKEN'
        ];

        static::assertSame('TEST_TOKEN', $initiate->getToken());
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
            'token' => 'TEST_TOKEN'
        ]);

        $manager = $this->createApiManager(null, 201);

        $result = $manager->create('TEST_API_KEY', $initiate);

        self::assertInstanceOf(Initiate::class, $result);
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
