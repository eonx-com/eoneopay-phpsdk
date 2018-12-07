<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Fees;

use EoneoPay\PhpSdk\Requests\Fees\CreditCardRequest;
use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Responses\Fees\CreditCardFee;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Fees\CreditCardRequest
 * @covers \EoneoPay\PhpSdk\Requests\Fees\FeeRequest
 */
class CreditCardRequestTest extends RequestTestCase
{
    /**
     * Test calculate fees.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testCalculateFees(): void
    {
        $data = [
            'action' => 'debit',
            'amount' => new Amount([
                'currency' => 'AUD',
                'payment_fee' => '0.10',
                'subtotal' => '100.00',
                'total' => '100.10'
            ]),
            'credit_card' => $this->getCreditCard()
        ];

        $response = $this->createClient($data)->create(new CreditCardRequest([
            'action' => 'debit',
            'amount' => new Amount([
                'currency' => 'AUD',
                'total' => '100.10'
            ]),
            'credit_card' => $this->getCreditCard()
        ]));

        self::assertInstanceOf(CreditCardFee::class, $response);
        /** @var \EoneoPay\PhpSdk\Responses\Fees\CreditCardFee $response */
        self::assertSame('100.10', $response->getAmount()->getTotal());
        self::assertSame('100.00', $response->getAmount()->getSubtotal());
        self::assertSame('0.10', $response->getAmount()->getPaymentFee());
    }
}
