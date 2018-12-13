<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\TestCases;

use EoneoPay\PhpSdk\Client;
use EoneoPay\PhpSdk\ClientConfiguration;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Payloads\Ewallet;
use Tests\EoneoPay\PhpSdk\MockClient;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren) Test case, all request tests extend this
 */
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
}
