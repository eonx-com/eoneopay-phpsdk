<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Endpoints;

use EoneoPay\PhpSdk\Requests\Endpoints\Tokens\CreditCardRequest;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Endpoints\TokenRequest
 */
class TokenRequestTest extends RequestTestCase
{
    /**
     * Test that get endpoint token info will throw exception when token is missing.
     *
     * @return void
     */
    public function testGetTokenInfoWillThrowException(): void
    {
        try {
            $this->createClient()->get(new CreditCardRequest());
        } catch (Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'token' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }
}
