<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Client;
use EoneoPay\PhpSdk\ClientConfiguration;
use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Payloads\Ewallet;
use EoneoPay\PhpSdk\Responses\Transaction;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren) Test case, all request tests extend this
 */
abstract class RequestTestCase extends TestCase
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
     * Create mock http client.
     *
     * @param mixed[] $body
     * @param int|null $responseCode
     *
     * @return \Tests\EoneoPay\PhpSdk\MockClient
     */
    protected function createClient(?array $body = null, ?int $responseCode = null): MockClient
    {
        $body = $body ?? [];

        return new MockClient($body, $responseCode, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * Create live http client.
     *
     * @return \EoneoPay\PhpSdk\Client
     */
    protected function createLiveClient(): Client
    {
        return new Client(new ClientConfiguration(
            (string)\getenv('PAYMENTS_API_KEY'),
            (string)\getenv('PAYMENTS_BASE_URI')
        ));
    }

    /**
     * Get bank account payload.
     *
     * @return \EoneoPay\PhpSdk\Requests\Payloads\BankAccount
     */
    protected function getBankAccount(): BankAccount
    {
        return new BankAccount([
            'country' => 'AU',
            'prefix' => '123123',
            'name' => 'John Wick',
            'number' => '0876601'
        ]);
    }

    /**
     * Get credit card payload.
     *
     * @return \EoneoPay\PhpSdk\Requests\Payloads\CreditCard
     */
    protected function getCreditCard(): CreditCard
    {
        return new CreditCard([
            'cvc' => '100',
            'expiry' => new Expiry([
                'month' => '05',
                'year' => '2099'
            ]),
            'name' => 'John Wick',
            'number' => '5123450000000008'
        ]);
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

    /**
     * Get ewallet payload.
     *
     * @return \EoneoPay\PhpSdk\Requests\Payloads\Ewallet
     */
    protected function getEwallet(): Ewallet
    {
        return new Ewallet([
            'name' => 'John Wick',
            'reference' => '2JERVUH6A3'
        ]);
    }

    /**
     * Get security data.
     *
     * @param mixed[]|null $data Security data.
     *
     * @return mixed[]
     */
    protected function getSecurityData(?array $data = null): array
    {
        $data = $data ?? [];

        return \array_merge([
            'amount' => new Amount([
                'currency' => 'AUD',
                'total' => '100.00'
            ]),
            'cavv' => null,
            'id' => 'external-security-id',
            'request_payload' => 'request-payload',
            'response_payload' => 'response-payload',
            'return_url' => 'http://localhost',
            'secured' => false,
            'status' => 'completed',
            'xid' => 'test-xid'
        ], $data);
    }

    /**
     * Get tokenised endpoint data.
     *
     * @return mixed[]
     */
    protected function getTokenisedData(): array
    {
        return [
            'endpoint_id' => 'test-endpoint-id',
            'id' => $this->generateId('id'),
            'name' => 'John Wick',
            'token' => $this->generateId('tok'),
            'user_id' => 'test-user-id'
        ];
    }
}
