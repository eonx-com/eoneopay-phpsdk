<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Endpoints\V2\Amount;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\Amount
 */
class AmountTest extends TestCase
{
    /**
     * Test Getters.
     *
     * @return void
     */
    public function testGetters(): void
    {
        $amount = new Amount([
            'currency' => 'AUD',
            'payment_fee' => '39.50',
            'sub_total' => '110.50',
            'total' => '150.00',
        ]);

        self::assertEquals('AUD', $amount->getCurrency());
        self::assertEquals('39.50', $amount->getPaymentFee());
        self::assertEquals('110.50', $amount->getSubtotal());
        self::assertEquals('150.00', $amount->getTotal());
        self::assertSame([], $amount->uris());
    }
}
