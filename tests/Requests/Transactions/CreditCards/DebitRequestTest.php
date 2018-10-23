<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Payloads\Allocation;
use EoneoPay\PhpSdk\Requests\Payloads\Allocations\Record;
use EoneoPay\PhpSdk\Requests\Payloads\Token;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\DebitRequest;
use EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\CreditCardTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\DebitRequest
 */
class DebitRequestTest extends RequestTestCase
{
    /**
     * Make sure the exception structure and validation rules are thrown as expected.
     *
     * @return void
     */
    public function testInvalidRequest(): void
    {
        $debit = new DebitRequest([]);

        try {
            $this->createClient([])->create($debit);
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'credit_card' => ['This value should not be null.'],
                    'amount' => ['This value should not be blank.'],
                    'id' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Make sure the exception structure and validation rules are thrown as expected
     * when allocation records are not provided.
     *
     * @return void
     */
    public function testInvalidRequestMissingAllocationRecords(): void
    {
        $debit = new DebitRequest(\array_merge(
            $this->getData(),
            ['allocations' => new Allocation([])]
        ));

        try {
            $this->createClient([])->create($debit);
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'allocations.records' => ['This value should not be null.'],
                    'allocations.amount' => ['This value should not be blank.'],
                    'allocations.ewallet' => ['This value should not be blank.'],
                    'credit_card' => ['This value should not be null.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Test a successful credit card debit request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testSuccessfulCreditCardDebit(): void
    {
        $data = $this->getData();
        $debit = new DebitRequest(\array_merge($data, ['credit_card' => $this->getCreditCard()]));

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->createClient($data)->create($debit);

        self::assertInstanceOf(TransactionResponse::class, $response);
        self::assertSame($data['amount'], $response->getAmount());
        self::assertSame($data['currency'], $response->getCurrency());
        self::assertSame('completed', $response->getStatus());
        self::assertNotNull($response->getCompletedAt());
        self::assertTrue($response->getApproved());
    }

    /**
     * Test a successful tokenised credit card debit request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testSuccessfulTokenisedCreditCardDebit(): void
    {
        $data = $this->getData();
        $debit = new DebitRequest(\array_merge($data, [
            'allocations' => new Allocation([
                'amount' => '50.00',
                'ewallet' => 'T9AGW29FKJEU7B7TJFT2',
                'records' => [
                    new Record([
                        'amount' => '25.00',
                        'ewallet' => 'ZB92JEBNZKZE44UGAJJ0'
                    ])
                ]
            ]),
            'credit_card' => new Token([
                'token' => 'GZNWCUTTUKDKM7APFTM3'
            ])
        ]));

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->createClient($data)->create($debit);

        self::assertInstanceOf(TransactionResponse::class, $response);
        self::assertSame($data['amount'], $response->getAmount());
        self::assertSame($data['currency'], $response->getCurrency());
        self::assertSame('completed', $response->getStatus());
        self::assertNotNull($response->getCompletedAt());
        self::assertTrue($response->getApproved());
    }
}
