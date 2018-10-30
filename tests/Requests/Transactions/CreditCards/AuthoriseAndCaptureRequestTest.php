<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\PrimaryRequest;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\SecondaryRequest;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\CreditCardTransactionRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\PrimaryRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\SecondaryRequest
 */
class AuthoriseAndCaptureRequestTest extends RequestTestCase
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
        $data = $this->getData();

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->createClient($data)->create(
            new PrimaryRequest(
                \array_merge($data, [
                    'credit_card' => $this->getCreditCard(),
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
        $data = $this->getData(\uniqid('', false));

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->createClient($data)->update(
            new SecondaryRequest(\array_merge($data, ['credit_card' => $this->getCreditCard()]))
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
                 \array_merge($data, ['credit_card' => $this->getCreditCard()])
             ));
        } catch (\Exception $exception) {
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
