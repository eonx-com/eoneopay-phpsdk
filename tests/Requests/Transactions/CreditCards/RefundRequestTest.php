<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\SecondaryRequest;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\CreditCardTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\SecondaryRequest
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
        $data = $this->getData($this->generateId());

        $refund = new SecondaryRequest($data);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->createClient($data)->delete($refund);

        // assertions
        $this->assertTransactionResponse($data, $response);
    }
}
