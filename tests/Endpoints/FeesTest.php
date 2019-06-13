<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\Fees;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Fees
 */
class FeesTest extends TestCase
{
    /**
     * Ensure uris method has create with the correct endpoint
     *
     * @return void
     */
    public function testUris(): void
    {
        $fees = new Fees();

        self::assertSame(
            '/calculate/fees',
            $fees->uris()['create'] ?? []
        );
    }
}
