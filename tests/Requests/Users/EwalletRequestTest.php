<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Requests\Users\EwalletRequest;
use EoneoPay\PhpSdk\Responses\Users\Ewallet;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Users\EwalletRequest
 */
class EwalletRequestTest extends RequestTestCase
{
    /**
     * Create ewallet will throw exception when id is not provided.
     *
     * @return void
     */
    public function testCreateFailsWithException(): void
    {
        try {
            $this->createClient([])->create(new EwalletRequest([]));
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'id' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Create ewallet for a user.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testCreateSuccessfully(): void
    {
        /** @var \EoneoPay\PhpSdk\Responses\Users\Ewallet $ewallet */
        $ewallet = $this->createClient([
            'reference' => '1242343'
        ])->create(new EwalletRequest([
                'id' => 'dodgyUser5'
        ]));

        self::assertInstanceOf(Ewallet::class, $ewallet);
        self::assertNotNull($ewallet->getReference());
    }
}
