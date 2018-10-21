<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\SchedulePayments;

use EoneoPay\PhpSdk\Requests\SchedulePayments\BankAccount\GetOrCreateRequest as BankAccountRequest;
use EoneoPay\PhpSdk\Requests\SchedulePayments\CreditCard\GetOrCreateRequest as CreditCardRequest;
use EoneoPay\PhpSdk\Requests\SchedulePayments\ListRequest;
use EoneoPay\PhpSdk\Requests\SchedulePayments\RemoveRequest;
use EoneoPay\PhpSdk\Responses\SchedulePayment;
use EoneoPay\Utils\Interfaces\UtcDateTimeInterface;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\SchedulePayments\BankAccount\GetOrCreateRequest
 * @covers \EoneoPay\PhpSdk\Requests\SchedulePayments\CreditCard\GetOrCreateRequest
 * @covers \EoneoPay\PhpSdk\Requests\SchedulePayments\ListRequest
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
    public function testCreateCreditCardSchedulePaymentsSuccessfully(): void
    {
        $data = $this->getSchedulePaymentData();

        /** @var \EoneoPay\PhpSdk\Responses\SchedulePayment $response */
        $response = $this->createClient($data)->create(new CreditCardRequest(\array_merge(
            $data,
            ['credit_card' => $this->getCreditCard()]
        )));

        self::assertInstanceOf(SchedulePayment::class, $response);
        self::assertSame($data['amount'], $response->getAmount());
        self::assertSame($data['currency'], $response->getCurrency());
        self::assertSame($data['frequency'], $response->getFrequency());
        self::assertSame($data['id'], $response->getId());
    }

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
        $response = $this->createClient($data)->create(new BankAccountRequest(\array_merge(
            $data,
            ['bank_account' => $this->getBankAccount()]
        )));

        self::assertInstanceOf(SchedulePayment::class, $response);
        self::assertSame($data['amount'], $response->getAmount());
        self::assertSame($data['currency'], $response->getCurrency());
        self::assertSame($data['frequency'], $response->getFrequency());
        self::assertSame($data['id'], $response->getId());
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

        $response = $this->createClient($data)->list(new ListRequest());

        /** @var \EoneoPay\PhpSdk\Responses\SchedulePayment[] $response */
        self::assertGreaterThan(0, \count($response));
        self::assertSame($data[0]['amount'], $response[0]->getAmount());
        self::assertSame($data[0]['currency'], $response[0]->getCurrency());
        self::assertSame($data[0]['frequency'], $response[0]->getFrequency());
        self::assertSame($data[0]['id'], $response[0]->getId());
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
     * Get schedule payment data.
     *
     * @return mixed[]
     */
    private function getSchedulePaymentData(): array
    {
        return [
            'actioning_user_id' => 'actioning-user-id',
            'amount' => '100.00',
            'currency' => 'AUD',
            'end_date' => null,
            'frequency' => 'monthly',
            'id' => \uniqid('scp', false),
            'source_endpoint_id' => 'source-endpoint-id',
            'start_date' => (new \DateTime())->format(UtcDateTimeInterface::FORMAT_ZULU),
            'user_id' => 'user-id'
        ];
    }
}
