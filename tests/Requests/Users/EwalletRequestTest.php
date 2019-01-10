<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Requests\Users\EwalletRequest;
use EoneoPay\PhpSdk\Responses\Users\Ewallet;
use EoneoPay\PhpSdk\Responses\Users\Ewallets\Balances;
use EoneoPay\Utils\Exceptions\BaseException;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\Stubs\Endpoints\EwalletResponseStub;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Users\EwalletRequest
 */
class EwalletRequestTest extends RequestTestCase
{
    /**
     * Test that create ewallet will throw exception when id is not provided.
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
     * Test create ewallet for a user successfully.
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
     * Test get ewallet for a user by reference successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testGetEwalletByReferenceSuccessfully(): void
    {
        $reference = 'CYY6G83ZX8';
        $balances = [
            'available' => '100.00',
            'balance' => '100.00'
        ];

        $responseStub = new EwalletResponseStub(\compact('balances', 'reference'));

        $ewallet = $this->createClient($responseStub->toArray())->get(new EwalletRequest([
            'id' => 'test-user-1',
            'reference' => $reference
        ]));

        self::assertInstanceOf(Ewallet::class, $ewallet);
        self::assertSame($reference, $ewallet->getReference());
        self::assertSame(
            $balances['available'],
            ($ewallet->getBalances() instanceof Balances) === true ? $ewallet->getBalances()->getAvailable() : ''
        );
        self::assertSame(
            $balances['balance'],
            ($ewallet->getBalances() instanceof Balances) === true ? $ewallet->getBalances()->getBalance() : ''
        );
    }

    /**
     * Test get ewallet for a user by reference successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testGetEwalletByTokenSuccessfully(): void
    {
        $token = $this->generateId();
        $balances = [
            'available' => '50.00',
            'balance' => '50.00'
        ];

        $responseStub = new EwalletResponseStub(\compact('balances', 'token'));

        $ewallet = $this->createClient($responseStub->toArray())->get(new EwalletRequest([
            'id' => 'test-user-1',
            'token' => $token
        ]));

        self::assertInstanceOf(Ewallet::class, $ewallet);
        self::assertSame($token, $ewallet->getToken());
        self::assertSame(
            $balances['available'],
            ($ewallet->getBalances() instanceof Balances) === true ? $ewallet->getBalances()->getAvailable() : ''
        );
        self::assertSame(
            $balances['balance'],
            ($ewallet->getBalances() instanceof Balances) === true ? $ewallet->getBalances()->getBalance() : ''
        );
    }

    /**
     * Test that get ewallet fails with exception when mandatory data is not provided.
     *
     * @return void
     */
    public function testGetEwalletFailsWithException(): void
    {
        try {
            $this->createClient()->get(new EwalletRequest([
                'id' => 'test-user-1'
            ]));
        } catch (Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'reference' => ['This field is required when token is not present.'],
                    'token' => ['This field is required when reference is not present.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
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
