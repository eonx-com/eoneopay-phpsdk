<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Payloads\Allocation;
use EoneoPay\PhpSdk\Requests\Payloads\Allocations\Record;
use EoneoPay\PhpSdk\Requests\Payloads\Token;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\PrimaryRequest;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardRequestStub;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\CreditCardTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\PrimaryRequest
 */
class DebitRequestTest extends TransactionTestCase
{
    /**
     * Make sure the exception structure and validation rules are thrown as expected.
     *
     * @return void
     */
    public function testInvalidRequest(): void
    {
        $debit = new PrimaryRequest([]);

        try {
            $this->createClient([])->create($debit);
        } catch (Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'amount' => ['This value should not be null.'],
                    'credit_card' => ['This value should not be null.'],
                    'action' => ['This value should not be blank.'],
                    'id' => ['This value should not be blank.'],
                    'secondary_id' => ['This value should not be blank.']
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
        $debit = new PrimaryRequest(\array_merge(
            $this->getData(),
            [
                'action' => 'debit',
                'allocation' => new Allocation([]),
                'credit_card' => new CreditCardRequestStub()
            ]
        ));

        try {
            $this->createClient([])->create($debit);
        } catch (Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'allocation.records' => ['This value should not be null.'],
                    'allocation.amount' => ['This value should not be blank.'],
                    'allocation.ewallet' => ['This value should not be blank.']
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
        $request = $this->getData();
        $debit = new PrimaryRequest(
            \array_merge($request, [
                'action' => 'debit',
                'credit_card' => new CreditCardRequestStub()
            ])
        );

        $data = \array_merge(
            $request,
            ['credit_card' => (new CreditCardResponseStub())->toArray()]
        );

        $response = $this->createClient($data)->create($debit);
        // assertions
        $this->assertTransactionResponse($data, $response);
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
        $request = $this->getData();
        $debit = new PrimaryRequest(\array_merge($request, [
            'action' => 'debit',
            'allocation' => new Allocation([
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

        $data = \array_merge(
            $request,
            ['credit_card' => (new CreditCardResponseStub())->toArray()]
        );

        $response = $this->createClient($data)->create($debit);
        // assertions
        $this->assertTransactionResponse($data, $response);
    }
}
