<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\RefundRequest;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\CreditCardTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\RefundRequest
 */
class RefundRequestTest extends RequestTestCase
{
    /**
     * Test a successful refund request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testSuccessfulRefundRequest(): void
    {
        $data = $this->getData(\uniqid('', false));

        $refund = new RefundRequest($data);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->createClient($data)->delete($refund);

        self::assertSame($data['amount'], $response->getAmount());
        self::assertSame($data['currency'], $response->getCurrency());
        self::assertSame($data['id'], $response->getId());
    }
}
