<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\Amount;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Amount
 */
final class AmountTest extends TestCase
{
    /**
     * Test creation of a balance entity.
     *
     * @return void
     */
    public function testAmountCreation(): void
    {
        $balance = new Amount([
            'currency' => 'AUD',
            'payment_fee' => '39.50',
            'sub_total' => '110.50',
            'total' => '150.00',
        ]);

        self::assertEquals('AUD', $balance->getCurrency());
        self::assertEquals('39.50', $balance->getPaymentFee());
        self::assertEquals('110.50', $balance->getSubtotal());
        self::assertEquals('150.00', $balance->getTotal());
    }
}
