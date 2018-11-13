<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\BankAccountTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Endpoints\Tokens\BankAccountTokenRequest
 */
class BankAccountTokenRequestTest extends RequestTestCase
{
    /**
     * Test a successful bank account tokenise request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testCreateTokenSuccessfully(): void
    {
        $data = $this->getTokenisedData();

        /** @var \EoneoPay\PhpSdk\Responses\Users\EndpointToken $response */
        $response = $this->createClient($data)->create(new BankAccountTokenRequest([
            'bank_account' => $this->getBankAccount()
        ]));

        self::assertSame($data['name'], $response->getName());
        self::assertSame($data['token'], $response->getToken());
    }

    /**
     * Make sure validation exception are expected.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testInvalidRequest(): void
    {
        try {
            $this->createClient([])->create(new BankAccountTokenRequest([
                'bank_account' => new BankAccount()
            ]));
        } catch (Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'bank_account.country' => ['This value should not be blank.'],
                    'bank_account.name' => ['This value should not be blank.'],
                    'bank_account.number' => ['This value should not be blank.'],
                    'bank_account.prefix' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }
}
