<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSources\Bpay;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSources\Bpay
 */
class BpayTest extends TestCase
{
    /**
     * Test get bpay payment source endpoint getters. There is no public api to create a Bpay payment source
     * hence only testing getters.
     *
     * @return void
     */
    public function testBpayPaymentSource(): void
    {
        $hash = $this->generateId();

        $paymentSource = new Bpay([
            'id' => $hash,
            'pan' => 'B...PAY',
            'biller_code' => '112233',
            'biller_name' => 'Test',
            'reference_number' => '1793768381',
        ]);

        self::assertSame($hash, $paymentSource->getId());
        self::assertSame('B...PAY', $paymentSource->getPan());
        self::assertSame('112233', $paymentSource->getBillerCode());
        self::assertSame('Test', $paymentSource->getBillerName());
        self::assertSame('1793768381', $paymentSource->getReferenceNumber());
    }
}
