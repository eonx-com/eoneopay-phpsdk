<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet
 */
class EwalletTest extends TestCase
{
    /**
     * Test if uri is created
     *
     * @return void
     */
    public function testUriIsCreated(): void
    {
        $class = new Ewallet();
        self::assertIsArray($class->uris());
        self::assertCount(1, $class->uris());
    }
}
