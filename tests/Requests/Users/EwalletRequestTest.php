<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Requests\Users\EwalletRequest;
use EoneoPay\PhpSdk\Responses\Users\Ewallet;
use EoneoPay\Utils\Exceptions\BaseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\EwalletResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

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
        } catch (BaseException $exception) {
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
        $ewallet = $this->createClient((new EwalletResponseStub())->toArray())->create(new EwalletRequest([
                'id' => 'test-user-1'
        ]));

        self::assertInstanceOf(Ewallet::class, $ewallet);
        self::assertNotNull($ewallet->getReference());
    }

    /**
     * List ewallets successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testListSuccessfully(): void
    {
        /** @var \Countable $ewallets */
        $ewallets = $this->createClient([
            [
                'currency' => 'AUD',
                'id' => \uniqid('', true),
                'pan' => '1...2343',
                'reference' => '1242343'
            ]
        ])->list(new EwalletRequest([
            'id' => 'sample-user-id-1'
        ]));

        self::assertCount(1, $ewallets);
    }
}
