<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Responses\Payloads\TokenisedCreditCard;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class CreditCardTokenRequestTest extends RequestTestCase
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
        $tokenise = new CreditCardTokenRequest([
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Payloads\TokenisedBankAccount $response */
        $response = $this->client->create($tokenise);

        self::assertInstanceOf(TokenisedCreditCard::class, $response);
        self::assertNotNull($response->getId());
    }
}
