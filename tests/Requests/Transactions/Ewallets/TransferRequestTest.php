<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\Ewallets;

use EoneoPay\PhpSdk\Requests\Payloads\Token;
use EoneoPay\PhpSdk\Requests\Transactions\Ewallets\PrimaryRequest;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\EwalletResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\Ewallets\EwalletTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\Ewallets\PrimaryRequest
 */
class TransferRequestTest extends TransactionTestCase
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
                    'ewallet' => ['This value should not be null.'],
                    'action' => ['This value should not be blank.'],
                    'id' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Test a successful ewallet transfer request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testSuccessfulCreditCardDebit(): void
    {
        $request = $this->getData();
        $transfer = new PrimaryRequest(
            \array_merge($request, [
                'action' => 'transfer',
                'ewallet' => new Token([
                    'token' => 'GZNWCUTTUKDKM7APFTM3'
                ]),
                'destination' => new Token([
                    'token' => 'GZNWCUTTUKDKM7APFTM3'
                ])
            ])
        );

        $data = \array_merge(
            $request,
            ['ewallet' => (new EwalletResponseStub())->toArray()]
        );

        $response = $this->createClient($data)->create($transfer);
        // assertions
        $this->assertTransactionResponse($data, $response);
    }
}
