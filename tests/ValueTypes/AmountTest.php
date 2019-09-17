<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\ValueTypes;

use EoneoPay\PhpSdk\ValueTypes\Amount;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\ValueTypes\Amount
 */
class AmountTest extends TestCase
{
    /**
     * Tests the class setters and getters to ensure the expected values are received once set and
     * formatted.
     *
     * @return void
     */
    public function testSetterGetter(): void
    {
        $amount = new Amount();
        $amount->setCurrency('AUD');
        $amount->setPaymentFee('1.00');
        $amount->setSubtotal('99.00');
        $amount->setTotal('100.00');

        self::assertSame('AUD', $amount->getCurrency());
        self::assertSame('1.00000000', $amount->getPaymentFee());
        self::assertSame('99.00000000', $amount->getSubtotal());
        self::assertSame('100.00000000', $amount->getTotal());
    }
}
