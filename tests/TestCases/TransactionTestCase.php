<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\TestCases;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Responses\Transaction;
use EoneoPay\PhpSdk\Responses\Transactions\BankAccount;
use EoneoPay\PhpSdk\Responses\Transactions\CreditCard;
use EoneoPay\PhpSdk\Responses\Transactions\Ewallet;

class TransactionTestCase extends RequestTestCase
{
    /**
     * Assert transaction endpoint.
     *
     * @param mixed[] $data
     * @param \EoneoPay\PhpSdk\Responses\Transaction $response
     *
     * @return void
     */
    protected function assertTransactionEndpoint(array $data, Transaction $response): void
    {
        if (($response instanceof BankAccount) === true) {
            /**
             * @var \EoneoPay\PhpSdk\Requests\Payloads\BankAccount $endpoint
             *
             * @see https://youtrack.jetbrains.com/issue/WI-37859 typehint required until PhpStorm recognises === check
             */
            $endpoint = $response->getBankAccount();
            $this->assertBankAccount($data, $endpoint);
        }

        if (($response instanceof CreditCard) === true) {
            /**
             * @var \EoneoPay\PhpSdk\Requests\Payloads\CreditCard $endpoint
             *
             * @see https://youtrack.jetbrains.com/issue/WI-37859 typehint required until PhpStorm recognises === check
             */
            $endpoint = $response->getCreditCard();
            $this->assertCreditCard($data, $endpoint);
        }

        if (($response instanceof Ewallet) === true) {
            /**
             * @var \EoneoPay\PhpSdk\Requests\Payloads\Ewallet $endpoint
             *
             * @see https://youtrack.jetbrains.com/issue/WI-37859 typehint required until PhpStorm recognises === check
             */
            $endpoint = $response->getEwallet();
            $this->assertEwallet($data, $endpoint);
        }
    }

    /**
     * Assert transaction response
     *
     * @param mixed[] $data
     * @param \EoneoPay\PhpSdk\Responses\Transaction $response
     *
     * @return void
     */
    protected function assertTransactionResponse(array $data, Transaction $response): void
    {
        /** @var \EoneoPay\PhpSdk\Requests\Payloads\Amount $amount */
        $amount = $data['amount'];

        self::assertSame(
            $amount->getTotal() ?? null,
            $response->getAmount() ? $response->getAmount()->getTotal() : null
        );
        self::assertSame(
            $amount->getCurrency() ?? null,
            $response->getAmount() ? $response->getAmount()->getCurrency() : null
        );
        self::assertSame('completed', $response->getStatus());

        // assertions for transaction endpoint
        $this->assertTransactionEndpoint($data, $response);
    }

    /**
     * Get request data for a transaction.
     *
     * @param null|string $originalId
     *
     * @return mixed[]
     */
    protected function getData(?string $originalId = null): array
    {
        return [
            'amount' => new Amount([
                'currency' => 'AUD',
                'total' => '100.00'
            ]),
            'id' => $this->generateId('test-'),
            'original_id' => $originalId,
            'name' => 'John Wick',
            'statement_description' => 'Test order'
        ];
    }
}
