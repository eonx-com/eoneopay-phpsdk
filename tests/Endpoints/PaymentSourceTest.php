<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSource
 */
class PaymentSourceTest extends TestCase
{
    /**
     * Test that get token information will return expected payment source.
     *
     * @return void
     */
    public function testGetTokenInfoSuccessfully(): void
    {
        $paymentSource = $this->createApiManager([
            'id' => $this->generateId(),
            'name' => 'John Wick',
            'pan' => '512345...0008',
            'token' => (string)\getenv('PAYMENTS_TOKEN_CREDIT_CARD'),
            'type' => 'credit_card'
        ])->getRepository(PaymentSource::class)->findByToken(
            (string)\getenv('PAYMENTS_TOKEN_CREDIT_CARD'),
            (string)\getenv('PAYMENTS_API_KEY')
        );

        self::assertInstanceOf(CreditCard::class, $paymentSource);
        self::assertSame((string)\getenv('PAYMENTS_TOKEN_CREDIT_CARD'), $paymentSource->getToken());
    }
}
