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
     * Bank account assertions.
     *
     * @param mixed[] $data Expectations
     * @param \EoneoPay\PhpSdk\Requests\Payloads\BankAccount $bankAccount Bank account payload response
     *
     * @return void
     */
    protected function assertBankAccount(array $data, BankAccount $bankAccount): void
    {
        self::assertSame($data['bank_account']['id'], $bankAccount->getId());
        self::assertSame($data['bank_account']['number'], $bankAccount->getNumber());
        self::assertSame($data['bank_account']['pan'], $bankAccount->getPan());
        self::assertSame($data['bank_account']['prefix'], $bankAccount->getPrefix());
    }

    /**
     * Credit card assertions.
     *
     * @param mixed[] $data Expectations
     * @param \EoneoPay\PhpSdk\Requests\Payloads\CreditCard $creditCard Credit card payload response
     *
     * @return void
     */
    protected function assertCreditCard(array $data, CreditCard $creditCard): void
    {
        $expiry = null;

        if (($creditCard->getExpiry() instanceof Expiry) === true) {
            $expiry = [
                'month' => $creditCard->getExpiry()->getMonth(),
                'year' => $creditCard->getExpiry()->getYear()
            ];
        }
        self::assertSame($data['credit_card']['country'], $creditCard->getCountry());
        self::assertSame($data['credit_card']['expiry'], $expiry);
        self::assertSame($data['credit_card']['id'], $creditCard->getId());
        self::assertSame($data['credit_card']['issuer'], $creditCard->getIssuer());
        self::assertSame($data['credit_card']['method'], $creditCard->getMethod());
        self::assertSame($data['credit_card']['pan'], $creditCard->getPan());
        self::assertSame($data['credit_card']['scheme'], $creditCard->getScheme());
    }

    /**
     * Ewallet assertions.
     *
     * @param mixed[] $data Expectations
     * @param \EoneoPay\PhpSdk\Requests\Payloads\Ewallet $ewallet Ewallet payload response
     *
     * @return void
     */
    protected function assertEwallet(array $data, Ewallet $ewallet): void
    {
        self::assertSame($data['ewallet']['currency'], $ewallet->getCurrency());
        self::assertSame($data['ewallet']['id'], $ewallet->getId());
        self::assertSame($data['ewallet']['pan'], $ewallet->getPan());
        self::assertSame($data['ewallet']['reference'], $ewallet->getReference());
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
}
