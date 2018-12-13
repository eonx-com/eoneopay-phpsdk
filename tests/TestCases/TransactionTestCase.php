<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\TestCases;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Responses\Transaction;

class TransactionTestCase extends RequestTestCase
{
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

        self::assertInstanceOf(Transaction::class, $response);
        self::assertSame(
            $amount->getTotal() ?? null,
            $response->getAmount() ? $response->getAmount()->getTotal() : null
        );
        self::assertSame(
            $amount->getCurrency() ?? null,
            $response->getAmount() ? $response->getAmount()->getCurrency() : null
        );
        self::assertSame('completed', $response->getStatus());
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
