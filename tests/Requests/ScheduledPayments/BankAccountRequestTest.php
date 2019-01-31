<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\ScheduledPayments;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount as BankAccountPayload;
use EoneoPay\PhpSdk\Requests\ScheduledPayments\BankAccount\CreateRequest;
use EoneoPay\PhpSdk\Requests\ScheduledPayments\BankAccount\GetRequest;
use EoneoPay\PhpSdk\Requests\ScheduledPayments\BankAccount\PayRequest;
use EoneoPay\PhpSdk\Requests\ScheduledPayments\RemoveRequest;
use EoneoPay\PhpSdk\Responses\ScheduledPayments\BankAccount;
use EoneoPay\PhpSdk\Responses\Transactions\BankAccount as BankAccountTransaction;
use EoneoPay\Utils\DateTime;
use EoneoPay\Utils\Interfaces\UtcDateTimeInterface;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\BankAccountRequestStub;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\BankAccountResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @noinspection EfferentObjectCouplingInspection High coupling for testing only
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects) High coupling for testing only
 *
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\AbstractPayRequest
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\BankAccount\CreateRequest
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\BankAccount\GetRequest
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\BankAccount\PayRequest
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\RemoveRequest
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\ScheduledPaymentRequest
 */
class BankAccountRequestTest extends TransactionTestCase
{
    /**
     * Test create schedule payment successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testCreateScheduledPaymentsSuccessfully(): void
    {
        $request = $this->getScheduledPaymentData();

        $data = \array_merge($request, $this->getEndpointData());

        $response = $this->createClient($data)->create(new CreateRequest(\array_merge(
            $request,
            ['bank_account' => new BankAccountRequestStub()]
        )));

        // assertions
        self::assertInstanceOf(BankAccount::class, $response);
        $this->assertScheduledPayment($data, $response);
    }

    /**
     * Test get schedule payment by id successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testGetScheduledPaymentsSuccessfully(): void
    {
        $data = \array_merge($this->getScheduledPaymentData(), $this->getEndpointData());

        $response = $this->createClient($data)->get(new GetRequest([
            'id' => $data['id']
        ]));

        // assertions
        self::assertInstanceOf(BankAccount::class, $response);
        $this->assertScheduledPayment($data, $response);
    }

    /**
     * Test list schedule payment successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testListScheduledPaymentsSuccessfully(): void
    {
        $data = [\array_merge($this->getScheduledPaymentData(), $this->getEndpointData())];

        $response = $this->createClient($data)->list(new GetRequest());

        self::assertGreaterThan(0, \count($response));

        // assertions
        self::assertInstanceOf(BankAccount::class, $response[0]);
        $this->assertScheduledPayment($data[0], $response[0]);
    }

    /**
     * Test one off payment successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testOneOffPaymentSuccessfully(): void
    {
        $data = \array_merge(
            $this->getData(),
            ['bank_account' => (new BankAccountResponseStub())->toArray()]
        );

        $response = $this->createClient($data)->create(new PayRequest([
            'amount' => new Amount([
                'currency' => $data['amount']->getCurrency(),
                'total' => $data['amount']->getTotal()
            ]),
            'bank_account' => new BankAccountRequestStub(),
            'paymentId' => 'valid-id'
        ]));

        self::assertInstanceOf(BankAccountTransaction::class, $response);
        self::assertSame($data['amount']->getTotal(), $response->getAmount()->getTotal());
        self::assertSame($data['amount']->getCurrency(), $response->getAmount()->getCurrency());
    }

    /**
     * Test remove schedule payment successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testRemoveScheduledPaymentSuccessfully(): void
    {
        self::assertNull($this->createClient([], 204)->delete(new RemoveRequest([
            'id' => 'bank-schedule-payment-id'
        ])));
    }

    /**
     * Assert schedule payment unit rest results.
     *
     * @param mixed[] $data
     * @param \EoneoPay\PhpSdk\Responses\ScheduledPayments\BankAccount $response
     *
     * @return void
     */
    private function assertScheduledPayment(array $data, BankAccount $response): void
    {
        /** @var \EoneoPay\PhpSdk\Requests\Payloads\Amount $amount */
        $amount = $data['amount'];

        self::assertInstanceOf(BankAccountPayload::class, $response->getBankAccount());

        /** @var \EoneoPay\PhpSdk\Requests\Payloads\BankAccount $endpoint */
        $endpoint = $response->getBankAccount();
        $this->assertBankAccount($data, $endpoint);

        self::assertSame(
            $amount->getTotal() ?? null,
            $response->getAmount() ? $response->getAmount()->getTotal() : null
        );
        self::assertSame(
            $amount->getCurrency() ?? null,
            $response->getAmount() ? $response->getAmount()->getCurrency() : null
        );
        self::assertSame($data['frequency'], $response->getFrequency());
        self::assertSame($data['id'], $response->getId());
    }

    /**
     * Get endpoint response data.
     *
     * @return mixed[]
     */
    private function getEndpointData(): array
    {
        return [
            'bank_account' => (new BankAccountResponseStub())->toArray()
        ];
    }

    /**
     * Get schedule payment data.
     *
     * @return mixed[]
     *
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    private function getScheduledPaymentData(): array
    {
        return [
            'amount' => new Amount([
                'currency' => 'AUD',
                'total' => '20.00'
            ]),
            'end_date' => null,
            'frequency' => 'P14D',
            'id' => $this->generateId('scp'),
            'start_date' => (new DateTime())->format(UtcDateTimeInterface::FORMAT_ZULU)
        ];
    }
}
