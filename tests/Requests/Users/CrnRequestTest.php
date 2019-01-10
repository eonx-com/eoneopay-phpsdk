<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Requests\Payloads\Ewallet;
use EoneoPay\PhpSdk\Requests\Users\CrnRequest;
use EoneoPay\PhpSdk\Responses\Users\ReferenceNumber;
use EoneoPay\Utils\Exceptions\BaseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Users\CrnRequest
 */
class CrnRequestTest extends RequestTestCase
{
    /**
     * Test generate crn fails with exception when invalid data is provided.
     *
     * @return void
     */
    public function testGenerateCrnFailsWithException(): void
    {
        $data = [];

        try {
            $this->createClient($data)->create(new CrnRequest($data));
        } catch (BaseException $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'ewallet' => ['This value should not be null.'],
                    'user_id' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Test generate crn for a user successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testGenerateCrnSuccessfully(): void
    {
        $data = [
            'reference_number' => $this->generateId()
        ];

        $crn = $this->createClient($data)->create(new CrnRequest([
            'ewallet' => new Ewallet([
                'reference' => 'CYY6G83ZX8',
                'name' => 'John Wick'
            ]),
            'user_id' => 'test-5beb99ff72015'
        ]));

        self::assertInstanceOf(ReferenceNumber::class, $crn);
        self::assertSame($data['reference_number'], $crn->getReferenceNumber());
    }
}
