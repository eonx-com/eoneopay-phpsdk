<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\BankAccountTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Responses\Users\EndpointTokens\BankAccountToken;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\BankAccountRequestStub;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\BankAccountResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

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

        $response = $this->createClient($data)->create(new BankAccountTokenRequest([
            'bank_account' => new BankAccountRequestStub()
        ]));

        self::assertInstanceOf(BankAccountToken::class, $response);
        self::assertInstanceOf(BankAccount::class, $response->getBankAccount());
        $this->assertBankAccount($data, $response->getBankAccount());
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

    /**
     * Get tokenised bank account data.
     *
     * @return mixed[]
     */
    protected function getTokenisedData(): array
    {
        return [
            'bank_account' => (new BankAccountResponseStub())->toArray(),
            'name' => 'John Wick',
            'token' => 'FBGBA2VJNTZD3Z9CBKR2'
        ];
    }
}
