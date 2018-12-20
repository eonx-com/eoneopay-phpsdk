<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\TestCases;

use EoneoPay\PhpSdk\Client;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Payloads\Ewallet;
use EoneoPay\Utils\DateTime;
use EoneoPay\Utils\Interfaces\UtcDateTimeInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

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
     * @return \EoneoPay\PhpSdk\Client
     *
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException If string passed to constructor is invalid
     */
    protected function createClient(?array $body = null, ?int $responseCode = null): Client
    {
        return (new Client())->setHandler(new MockHandler([
            new Response(
                $responseCode ?? 200,
                ['Accept' => 'application/json', 'Content-Type' => 'application/json'],
                \json_encode($this->formatData($body ?? []))
            )
        ]));
    }

    /**
     * Create live http client.
     *
     * @return \EoneoPay\PhpSdk\Client
     */
    protected function createLiveClient(): Client
    {
        return (new Client())->setApiKey((string)\getenv('PAYMENTS_API_KEY'))
            ->setBaseUri((string)\getenv('PAYMENTS_BASE_URI'));
    }

    /**
     * Format response data.
     *
     * @param mixed[] $content
     *
     * @return mixed[]
     *
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    private function formatData(array $content): array
    {
        if (isset($content['amount'])) {
            /**  @var \EoneoPay\PhpSdk\Requests\Payloads\Amount $amount */
            $amount = $content['amount'];

            $content = \array_replace($content, [
                'approved' => true,
                'completed_at' => (new DateTime())->format(UtcDateTimeInterface::FORMAT_ZULU),
                'amount' => [
                    'currency' => $amount->getCurrency(),
                    'payment_fee' => $amount->getPaymentFee(),
                    'subtotal' => $amount->getSubtotal(),
                    'total' => $amount->getTotal()
                ],
                'status' => 'completed'
            ]);
        }

        if (\array_key_exists(0, $content) === true) {
            $content[0] = $this->formatData($content[0]);
        }

        return $content;
    }
}
