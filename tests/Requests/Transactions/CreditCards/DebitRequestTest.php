<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Payloads\Allocation;
use EoneoPay\PhpSdk\Requests\Payloads\Allocations\Record;
use EoneoPay\PhpSdk\Requests\Payloads\Token;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\PrimaryRequest;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\CreditCardTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\PrimaryRequest
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
        $debit = new PrimaryRequest(\array_merge(
            $this->getData(),
            [
                'action' => 'debit',
                'allocations' => new Allocation([]),
                'credit_card' => $this->getCreditCard()
            ]
        ));

        try {
            $this->createClient([])->create($debit);
        } catch (Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'allocations.records' => ['This value should not be null.'],
                    'allocations.amount' => ['This value should not be blank.'],
                    'allocations.ewallet' => ['This value should not be blank.']
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
        $debit = new PrimaryRequest(
            \array_merge($data, [
                'action' => 'debit',
                'credit_card' => $this->getCreditCard()
            ])
        );

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
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
        $data = $this->getData();
        $debit = new PrimaryRequest(\array_merge($data, [
            'action' => 'debit',
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

        // assertions
        $this->assertTransactionResponse($data, $response);
    }
}
