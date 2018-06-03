<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Responses\Payloads\TokenisedBankAccount;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class BankAccountTokenRequestTest extends RequestTestCase
{
    /**
     * Test successful token creation.
     *
     * @return void
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     */
    public function testCreateTokenSuccessfully(): void
    {
        $tokenise = new BankAccountTokenRequest([
            'bank_account' => new BankAccount([
                'bsb' => '333-333',
                'name' => 'NateDaBomb',
                'number' => '0876601'
            ])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Payloads\TokenisedBankAccount $response */
        $response = $this->client->create($tokenise);

        self::assertInstanceOf(TokenisedBankAccount::class, $response);
        self::assertEquals('333-333', $response->getBsb());
        self::assertNotNull($response->getId());
    }
}
