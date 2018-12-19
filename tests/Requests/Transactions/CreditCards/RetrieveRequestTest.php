<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\RetrieveRequest;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\RetrieveRequest
 */
class RetrieveRequestTest extends TransactionTestCase
{
    /**
     * Test retrieve transaction successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testRetrieveTransactionSuccessfully(): void
    {
        $data = \array_merge(
            $this->getData(),
            ['credit_card' => (new CreditCardResponseStub())->toArray()]
        );

        $response = $this->createClient($data)->get(new RetrieveRequest([
            'id' => $data['id']
        ]));

        // assertions
        $this->assertTransactionResponse($data, $response);
    }
}
