<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSource
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount
 */
class BankAccountTest extends TestCase
{
    /**
     * Test if bank account token is created successfully
     *
     * @return void
     */
    public function testCreateBankAccountToken(): void
    {
        $bankAccount = new BankAccount(
            [
                'country' => 'AU',
                'name' => 'User Name',
                'number' => '987654321',
                'prefix' => '123456',
                'type' => 'bank_account'
            ]
        );
        $actual = $this->createApiManager(
            [
                'country' => 'AU',
                'created_at' => '2019-02-14T06=>14=>06Z',
                'currency' => 'AUD',
                'id' => 'f5bebcb6cdedb1de9844df53365d2c51',
                'name' => 'User Name',
                'number' => '987654321',
                'pan' => '123-456...4321',
                'prefix' => '123-456',
                'token' => 'G88THZKX423DFGREVWY9',
                'type' => 'bank_account',
                'updated_at' => '2019-02-14T06=>14=>06Z'
            ]
        )->create('4UM78RDZW93B84UJ', $bankAccount);

        self::assertInstanceOf(BankAccount::class, $actual);
        self::assertIsString(($actual instanceof PaymentSource) ? $actual->getToken() : null);
    }

    /**
     * Test that get token information will return bank account payment source.
     *
     * @return void
     */
    public function testGetBankAccountTokenInfoSuccessfully(): void
    {
        /** @var \EoneoPay\PhpSdk\Repositories\PaymentSourceRepository $repository */
        $repository = $this->createApiManager([
            'id' => $this->generateId(),
            'name' => 'John Wick',
            'pan' => '123-456...4321',
            'token' => '3T93F7TXCVGX4ZV7AFW2',
            'type' => 'bank_account'
        ])->getRepository(PaymentSource::class);

        $paymentSource = $repository->findByToken(
            '3T93F7TXCVGX4ZV7AFW2',
            (string)\getenv('PAYMENTS_API_KEY')
        );

        self::assertInstanceOf(BankAccount::class, $paymentSource);
        self::assertSame(
            '3T93F7TXCVGX4ZV7AFW2',
            ($paymentSource instanceof PaymentSource) === true ? $paymentSource->getToken() : null
        );
    }

    /**
     * Test if uri is created
     *
     * @return void
     */
    public function testUriIsCreated(): void
    {
        $class = new BankAccount();
        self::assertIsArray($class->uris());
        self::assertCount(2, $class->uris());
    }
}
