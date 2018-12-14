<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\RetrieveRequest;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\BankAccountResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\BankAccounts\RetrieveRequest
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
            ['bank_account' => (new BankAccountResponseStub())->toArray()]
        );

        $response = $this->createClient($data)->get(new RetrieveRequest([
            'id' => $data['id']
        ]));

        // assertions
        $this->assertTransactionResponse($data, $response);
    }
}
