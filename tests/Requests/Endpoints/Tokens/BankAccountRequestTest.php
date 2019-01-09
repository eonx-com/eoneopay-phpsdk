<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Endpoints\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\BankAccountRequest;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Responses\Users\EndpointTokens\BankAccountToken;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\BankAccountResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Endpoints\Tokens\BankAccountRequest
 */
class BankAccountRequestTest extends RequestTestCase
{
    /**
     * Test get bank account token info successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testGetTokenInfo(): void
    {
        $data = $this->getTokenisedData();

        $response = $this->createClient($data)->get(new BankAccountRequest([
            'token' => 'FBGBA2VJNTZD3Z9CBKR2'
        ]));

        self::assertInstanceOf(BankAccountToken::class, $response);
        self::assertInstanceOf(BankAccount::class, $response->getBankAccount());
        $this->assertBankAccount($data, $response->getBankAccount());
        self::assertSame($data['name'], $response->getName());
        self::assertSame($data['token'], $response->getToken());
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
