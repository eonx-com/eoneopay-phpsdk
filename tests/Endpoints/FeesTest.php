<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\Fees;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Fees
 */
final class FeesTest extends TestCase
{
    /**
     * Test the hydration of endpoint object.
     *
     * @return void
     */
    public function testCalculcatingFeesPopulatesAttributes(): void
    {
        $response = [
            'action' => 'debit',
            'amount' => [
                'currency' => 'AUD',
                'payment_fee' => '4.00',
                'subtotal' => '96.00',
                'total' => '100.00',
            ],
            'payment_destination' => [
                'expiry' => [
                    'month' => '5',
                    'year' => '2099',
                ],
                'facility' => 'Visa',
                'name' => 'Endpoint Name',
                'pan' => '2.....5',
                'token' => 'A1B8',
                'type' => 'credit_card',
            ],
        ];

        /**
         * @var \EoneoPay\PhpSdk\Endpoints\Fees $fees
         */
        $fees = $this->createApiManager($response, 200)
            ->create((string)\getenv('PAYMENTS_API_KEY'), new Fees());

        self::assertSame('debit', $fees->getAction());
        self::assertSame(
            [
                'currency' => 'AUD',
                'payment_fee' => '4.00',
                'subtotal' => '96.00',
                'total' => '100.00',
            ],
            $fees->getAmount()
        );
        // Loose assertion due to symfony serializer handling this as a separate endpoint
        self::assertInstanceOf(CreditCard::class, $fees->getPaymentDestination());
        self::assertNull($fees->getPaymentSource());
    }

    /**
     * Ensure uris method has create with the correct endpoint.
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
