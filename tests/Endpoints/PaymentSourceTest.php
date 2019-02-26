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
        /** @var \EoneoPay\PhpSdk\Repositories\PaymentSourceRepository $repository */
        $repository = $this->createApiManager([
            'id' => $this->generateId(),
            'name' => 'John Wick',
            'pan' => '512345...0008',
            'token' => 'VRG2VR4F39343HM4D3N2',
            'type' => 'credit_card'
        ])->getRepository(PaymentSource::class);

        $paymentSource = $repository->findByToken(
            'VRG2VR4F39343HM4D3N2',
            (string)\getenv('PAYMENTS_API_KEY')
        );

        self::assertInstanceOf(CreditCard::class, $paymentSource);
        self::assertSame(
            'VRG2VR4F39343HM4D3N2',
            ($paymentSource instanceof PaymentSource) === true ? $paymentSource->getToken() : null
        );
    }
}
