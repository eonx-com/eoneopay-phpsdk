<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Fees\Contracts;

use EoneoPay\Utils\Exceptions\BaseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\Stubs\Fees\ContractRequestStub;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Fees\ContractRequest
 */
class ContractRequestTest extends RequestTestCase
{
    /**
     * Test contract fee request validation.
     *
     * @return void
     */
    public function testValidation(): void
    {
        try {
            $this->createClient()->create(new ContractRequestStub());
        } catch (BaseException $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'currency' => ['This value should not be blank.'],
                    'fixed' => ['This value should not be blank.'],
                    'variable' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame(
                $expected,
                ($exception instanceof ValidationException) === true ? $exception->getErrors() : []
            );
        }
    }
}
