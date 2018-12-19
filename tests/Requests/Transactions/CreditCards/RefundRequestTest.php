<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\SecondaryRequest;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\CreditCardTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\SecondaryRequest
 */
class RefundRequestTest extends TransactionTestCase
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
        $request = $this->getData($this->generateId());

        $refund = new SecondaryRequest($request);

        $data = \array_merge(
            $request,
            ['credit_card' => (new CreditCardResponseStub())->toArray()]
        );

        $response = $this->createClient($data)->delete($refund);
        // assertions
        $this->assertTransactionResponse($data, $response);
    }
}
