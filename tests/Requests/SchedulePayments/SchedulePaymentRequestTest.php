<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\SchedulePayments;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Requests\SchedulePayments\BankAccount\CreateRequest as BankAccountCreateRequest;
use EoneoPay\PhpSdk\Requests\SchedulePayments\CreditCard\CreateRequest as CreditCardCreateRequest;
use EoneoPay\PhpSdk\Requests\SchedulePayments\GetRequest;
use EoneoPay\PhpSdk\Requests\SchedulePayments\RemoveRequest;
use EoneoPay\PhpSdk\Responses\SchedulePayment;
use EoneoPay\Utils\Interfaces\UtcDateTimeInterface;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\SchedulePayments\BankAccount\CreateRequest
 * @covers \EoneoPay\PhpSdk\Requests\SchedulePayments\CreditCard\CreateRequest
 * @covers \EoneoPay\PhpSdk\Requests\SchedulePayments\GetRequest
 * @covers \EoneoPay\PhpSdk\Requests\SchedulePayments\RemoveRequest
 */
class SchedulePaymentRequestTest extends RequestTestCase
{
    /**
     * Test create schedule payment successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testCreateBankAccountSchedulePaymentsSuccessfully(): void
    {
        $data = $this->getSchedulePaymentData();

        /** @var \EoneoPay\PhpSdk\Responses\SchedulePayment $response */
        $response = $this->createClient($data)->create(new BankAccountCreateRequest(\array_merge(
            $data,
            ['bank_account' => $this->getBankAccount()]
        )));

        // assertions
        $this->assertSchedulePayment($data, $response);
    }

    /**
     * Test create schedule payment successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testCreateCreditCardSchedulePaymentsSuccessfully(): void
    {
        $data = $this->getSchedulePaymentData();

        /** @var \EoneoPay\PhpSdk\Responses\SchedulePayment $response */
        $response = $this->createClient($data)->create(new CreditCardCreateRequest(\array_merge(
            $data,
            ['credit_card' => $this->getCreditCard()]
        )));

        // assertions
        $this->assertSchedulePayment($data, $response);
    }

    /**
     * Test list schedule payment successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testListSchedulePaymentsSuccessfully(): void
    {
        $data = [$this->getSchedulePaymentData()];

        $response = $this->createClient($data)->list(new GetRequest());

        /** @var \EoneoPay\PhpSdk\Responses\SchedulePayment[] $response */
        self::assertGreaterThan(0, \count($response));

        // assertions
        $this->assertSchedulePayment($data[0], $response[0]);
    }

    /**
     * Test remove schedule payment successfully.
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testRemoveSchedulePaymentSuccessfully(): void
    {
        $response = $this->createClient([], 204)->delete(new RemoveRequest([
            'id' => 'schedule-payment-id'
        ]));

        self::assertNull($response);
    }

    /**
     * Assert schedule payment unit rest results.
     *
     * @param mixed[] $data
     * @param \EoneoPay\PhpSdk\Responses\SchedulePayment $response
     *
     * @return void
     */
    private function assertSchedulePayment(array $data, SchedulePayment $response): void
    {
        /** @var \EoneoPay\PhpSdk\Requests\Payloads\Amount $amount */
        $amount = $data['amount'];

        self::assertInstanceOf(SchedulePayment::class, $response);
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
     * Get schedule payment data.
     *
     * @return mixed[]
     */
    private function getSchedulePaymentData(): array
    {
        return [
            'amount' => new Amount([
                'currency' => 'AUD',
                'total' => '100.00'
            ]),
            'end_date' => null,
            'frequency' => 'monthly',
            'id' => \uniqid('scp', false),
            'start_date' => (new \DateTime())->format(UtcDateTimeInterface::FORMAT_ZULU)
        ];
    }
}
