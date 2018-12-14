<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\PrimaryRequest;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\SecondaryRequest;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardRequestStub;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\CreditCardResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\CreditCardTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\PrimaryRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\SecondaryRequest
 */
class AuthoriseAndCaptureRequestTest extends TransactionTestCase
{
    /**
     * Test authorise a credit card transaction successfully.
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     *
     * @return void
     */
    public function testAuthoriseSuccessfully(): void
    {
        $request = $this->getData();

        $data = \array_merge(
            $request,
            ['credit_card' => (new CreditCardResponseStub())->toArray()]
        );

        $response = $this->createClient($data)->create(
            new PrimaryRequest(
                \array_merge($request, [
                    'credit_card' => new CreditCardRequestStub(),
                    'action' => 'authorise'
                ])
            )
        );

        // assertions
        $this->assertTransactionResponse($data, $response);
    }

    /**
     * Test authorise a credit card transaction successfully.
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     *
     * @return void
     */
    public function testCaptureSuccessfully(): void
    {
        $request = $this->getData($this->generateId());

        $data = \array_merge(
            $request,
            ['credit_card' => (new CreditCardResponseStub())->toArray()]
        );

        $response = $this->createClient($data)->update(
            new SecondaryRequest(\array_merge($request, ['credit_card' => new CreditCardRequestStub()]))
        );

        // assertions
        $this->assertTransactionResponse($data, $response);
    }

    /**
     * Test authorise validation exception.
     *
     * @return void
     */
    public function testValidationException(): void
    {
        // invalid data
        $data = [
            'currency' => 'AUDS',
            'name' => 'John Wick',
            'statement_description' => 'Test order'
        ];

        try {
            $this->createClient($data)->create(new PrimaryRequest(
                \array_merge($data, ['credit_card' => new CreditCardRequestStub()])
            ));
        } catch (Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'amount' => ['This value should not be null.'],
                    'action' => ['This value should not be blank.'],
                    'id' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }
}
