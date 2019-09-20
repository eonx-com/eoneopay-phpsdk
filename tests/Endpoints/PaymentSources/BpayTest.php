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
     * Test get Bpay token information returns expected information about the Bpay endpoint.
     *
     * @return void
     */
    public function testGetBpayTokenInfo(): void
    {
        $hash = $this->generateId();

        $apiManager = $this->createApiManager([
            'ewallet' => [
                'id' => $this->generateId(),
                'pan' => 'D...WERE',
                'primary' => true,
                'reference' => 'DY34YCWERE',
                'type' => 'ewallet',
                'soft_limit' => null,
                'credit_limit' => null,
                'currency' => 'AUD',
                'user' => [
                    'email' => 'user@email.test',
                    'metadata' => [],
                    'name' => 'John Wick',
                ],
            ],
            'id' => $hash,
            'pan' => 'B...PAY',
            'type' => 'bpay',
            'biller_code' => '112233',
            'biller_name' => 'Test',
            'reference_number' => '1793768381',
            'user' => [
                'email' => 'user@email.test',
                'metadata' => [],
                'name' => 'John Wick',
            ],
        ]);

        /** @var \EoneoPay\PhpSdk\Endpoints\PaymentSource $paymentSource */
        $paymentSource = $apiManager->find(
            Bpay::class,
            (string)\getenv('PAYMENTS_API_KEY'),
            $hash
        );

        self::assertInstanceOf(Bpay::class, $paymentSource);
        /** @var \EoneoPay\PhpSdk\Endpoints\PaymentSources\Bpay $paymentSource */
        self::assertSame($hash, $paymentSource->getId());
        self::assertSame('B...PAY', $paymentSource->getPan());
        self::assertSame('112233', $paymentSource->getBillerCode());
        self::assertSame('Test', $paymentSource->getBillerName());
        self::assertSame('1793768381', $paymentSource->getReferenceNumber());
        self::assertNull($paymentSource->getAllocationEwallet());
        self::assertSame('DY34YCWERE', $paymentSource->getEwallet()->getReference());
    }
}
