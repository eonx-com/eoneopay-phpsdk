<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\AuthoriseRequest;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\AuthoriseRequest
 * @covers \EoneoPay\PhpSdk\Requests\Transactions\CreditCards\CreditCardTransactionRequest
 */
class AuthoriseRequestTest extends RequestTestCase
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
            new AuthoriseRequest(\array_merge($data, ['credit_card' => $this->getCreditCard()]))
        );

        self::assertSame($data['amount'], $response->getAmount());
        self::assertSame($data['currency'], $response->getCurrency());
        self::assertSame($data['id'], $response->getId());
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
            new AuthoriseRequest(\array_merge($data, ['credit_card' => $this->getCreditCard()]))
        );

        self::assertSame($data['amount'], $response->getAmount());
        self::assertSame($data['currency'], $response->getCurrency());
        self::assertSame($data['id'], $response->getId());
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
            'amount' => '100.00',
            'currency' => 'AUDS',
            'name' => 'John Wick',
            'statement_description' => 'Test order'
        ];

        try {
             $this->createClient($data)->create(new AuthoriseRequest(
                 \array_merge($data, ['credit_card' => $this->getCreditCard()])
             ));
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'currency' => ['This value is not a valid currency.'],
                    'id' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }
}
