<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\BankAccountTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class BankAccountTokenRequestTest extends RequestTestCase
{
    /**
     * Test a successful bank account tokenise request.
     *
     * @return void
     *
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    public function testCreateTokenSuccessfully(): void
    {
        $tokenise = new BankAccountTokenRequest([
            'bank_account' => new BankAccount([
                'bsb' => '123123',
                'name' => 'Julian',
                'number' => '0876601'
            ])
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Endpoints\Tokens\TokenisedEndpoint $response */
        $response = $this->client->create($tokenise);

        self::assertEquals('Julian', $response->getName());
        self::assertNotNull($response->getToken());
    }

    /**
     * Make sure validation exception are expected.
     *
     * @return void
     *
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    public function testInvalidRequest(): void
    {
        $tokenise = new BankAccountTokenRequest([
            'bank_account' => new BankAccount()
        ]);

        try {
            $this->client->create($tokenise);
        } catch (ValidationException $exception) {
            $expected = [
                'violations' => [
                    'bank_account.bsb' => ['This value should not be blank.'],
                    'bank_account.name' => ['This value should not be blank.'],
                    'bank_account.number' => ['This value should not be blank.']
                ]
            ];
            self::assertSame($expected, $exception->getErrors());
        }
    }
}
