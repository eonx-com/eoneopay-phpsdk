<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Client;
use EoneoPay\PhpSdk\ClientConfiguration;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Payloads\Ewallet;
use EoneoPay\Utils\Interfaces\UtcDateTimeInterface;

abstract class RequestTestCase extends TestCase
{
    /**
     * Create mock http client.
     *
     * @param mixed[] $body
     * @param int|null $responseCode
     *
     * @return \Tests\EoneoPay\PhpSdk\MockClient
     */
    protected function createClient(array $body, ?int $responseCode = null): MockClient
    {
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
            'amount' => '100.00',
            'approved' => true,
            'completed_at' => (new \DateTime())->format(UtcDateTimeInterface::FORMAT_ZULU),
            'currency' => 'AUD',
            'id' => \uniqid('', false),
            'original_id' => $originalId,
            'name' => 'John Wick',
            'statement_description' => 'Test order',
            'status' => 'completed'
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
     * Get tokenised endpoint data.
     *
     * @return mixed[]
     */
    protected function getTokenisedData(): array
    {
        return [
            'endpoint_id' => 'test-endpoint-id',
            'id' => \uniqid('id', false),
            'name' => 'John Wick',
            'token' => \uniqid('tok', false),
            'user_id' => 'test-user-id'
        ];
    }
}
