<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\ScheduledPayments;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard as CreditCardPayload;
use EoneoPay\PhpSdk\Requests\ScheduledPayments\CreditCard\CreateRequest;
use EoneoPay\PhpSdk\Requests\ScheduledPayments\CreditCard\GetRequest;
use EoneoPay\PhpSdk\Requests\ScheduledPayments\CreditCard\PayRequest;
use EoneoPay\PhpSdk\Requests\ScheduledPayments\RemoveRequest;
use EoneoPay\PhpSdk\Responses\ScheduledPayments\CreditCard;
use EoneoPay\PhpSdk\Responses\Transactions\CreditCard as CreditCardTransaction;
use EoneoPay\Utils\DateTime;
use EoneoPay\Utils\Interfaces\UtcDateTimeInterface;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardRequestStub;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardResponseStub;
use Tests\EoneoPay\PhpSdk\Stubs\ScheduledPayments\AllocationStub;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @noinspection EfferentObjectCouplingInspection High coupling for testing only
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects) High coupling for testing only
 *
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\AbstractPayRequest
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\CreditCard\CreateRequest
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\CreditCard\GetRequest
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\CreditCard\PayRequest
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\RemoveRequest
 * @covers \EoneoPay\PhpSdk\Requests\ScheduledPayments\ScheduledPaymentRequest
 */
class CreditCardRequestTest extends TransactionTestCase
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
            ['credit_card' => new CreditCardRequestStub(), 'allocation' => new AllocationStub()]
        )));

        // assertions
        self::assertInstanceOf(CreditCard::class, $response);
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
        self::assertInstanceOf(CreditCard::class, $response);
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
        self::assertInstanceOf(CreditCard::class, $response[0]);
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
            ['credit_card' => (new CreditCardResponseStub())->toArray()]
        );

        $response = $this->createClient($data)->create(new PayRequest([
            'amount' => new Amount([
                'currency' => $data['amount']->getCurrency(),
                'total' => $data['amount']->getTotal()
            ]),
            'credit_card' => new CreditCardRequestStub(),
            'paymentId' => 'valid-id'
        ]));

        self::assertInstanceOf(CreditCardTransaction::class, $response);
        self::assertSame($data['amount']->getCurrency(), $response->getAmount()->getCurrency());
        self::assertSame($data['amount']->getTotal(), $response->getAmount()->getTotal());
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
            'id' => 'card-schedule-payment-id'
        ])));
    }

    /**
     * Assert schedule payment unit rest results.
     *
     * @param mixed[] $data
     * @param \EoneoPay\PhpSdk\Responses\ScheduledPayments\CreditCard $response
     *
     * @return void
     */
    private function assertScheduledPayment(array $data, CreditCard $response): void
    {
        /** @var \EoneoPay\PhpSdk\Requests\Payloads\Amount $amount */
        $amount = $data['amount'];

        self::assertInstanceOf(CreditCardPayload::class, $response->getCreditCard());

        /** @var \EoneoPay\PhpSdk\Requests\Payloads\CreditCard $endpoint */
        $endpoint = $response->getCreditCard();
        $this->assertCreditCard($data, $endpoint);

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
            'credit_card' => (new CreditCardResponseStub())->toArray()
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
                'total' => '100.00'
            ]),
            'end_date' => null,
            'frequency' => 'P1M',
            'id' => $this->generateId('scp'),
            'start_date' => (new DateTime())->format(UtcDateTimeInterface::FORMAT_ZULU)
        ];
    }
}
