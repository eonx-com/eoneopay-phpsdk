<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Fees\Calculate;

use EoneoPay\PhpSdk\Requests\Fees\Calculate\CreditCardRequest;
use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Responses\Fees\Calculate\CreditCardFee;
use EoneoPay\Utils\Exceptions\BaseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardRequestStub;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Fees\Calculate\CalculateRequest
 * @covers \EoneoPay\PhpSdk\Requests\Fees\Calculate\CreditCardRequest
 */
class CreditCardRequestTest extends RequestTestCase
{
    /**
     * Test calculate credit card transaction fee.
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
            'credit_card' => new CreditCardRequestStub()
        ];

        $response = $this->createClient($data)->create(new CreditCardRequest([
            'action' => 'debit',
            'amount' => new Amount([
                'currency' => 'AUD',
                'total' => '100.10'
            ]),
            'credit_card' => new CreditCardRequestStub()
        ]));

        self::assertInstanceOf(CreditCardFee::class, $response);
        /** @var \EoneoPay\PhpSdk\Responses\Fees\Calculate\CreditCardFee $response */
        self::assertSame('100.10', $response->getAmount()->getTotal());
        self::assertSame('100.00', $response->getAmount()->getSubtotal());
        self::assertSame('0.10', $response->getAmount()->getPaymentFee());
    }

    /**
     * Test calculate fees will throw validation exception if invalid data is provided.
     *
     * @return void
     */
    public function testCalculateFeesThrowsValidationException(): void
    {
        try {
            $this->createClient()->create(new CreditCardRequest([
                'amount' => new Amount([
                    'total' => '100.10'
                ]),
                'credit_card' => new CreditCardRequestStub()
            ]));
        } catch (BaseException $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'action' => ['This value should not be blank.'],
                    'amount.currency' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame(
                $expected,
                ($exception instanceof ValidationException) === true ? $exception->getErrors() : []
            );
        }
    }
}
