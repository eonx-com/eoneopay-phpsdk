<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSource
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet
 */
class EwalletTest extends TestCase
{
    /**
     * Test if Ewalllet token is created successfully
     *
     * @return void
     */
    public function testCreateEwalletToken(): void
    {
        $ewallet = new Ewallet(
            [
                'name' => 'User Name',
                'reference' => 'JEKYYFZAR0',
                'type' => 'ewallet'
            ]
        );
        $actual = $this->createApiManager(
            [
                'created_at' => '2019-02-25T02=>40=>32Z',
                'currency' => 'AUD',
                'id' => '6524e7d900805b9de1cc91d4864988ec',
                'name' => 'User Name',
                'pan' => 'J...ZAR0',
                'primary' => false,
                'reference' => 'JEKYYFZAR0',
                'token' => 'T4BHBU66ZE3B86F2GZD7',
                'type' => 'ewallet',
                'updated_at' => '2019-02-25T02=>40=>32Z',
                'user' => [
                    'created_at' => '2019-02-22T03=>09=>44Z',
                    'email' => 'example@user.test',
                    'updated_at' => '2019-02-22T03=>09=>44Z'
                ]
            ]
        )->create('4UM78RDZW93B84UJ', $ewallet);

        self::assertInstanceOf(Ewallet::class, $actual);
        self::assertIsString(($actual instanceof Ewallet) ? $actual->getToken() : null);
    }

    /**
     * Test that get token information will return ewallet payment source.
     *
     * @return void
     */
    public function testGetEwalletTokenInfoSuccessfully(): void
    {
        /** @var \EoneoPay\PhpSdk\Repositories\PaymentSourceRepository $repository */
        $repository = $this->createApiManager([
            'id' => $this->generateId(),
            'name' => 'John Wick',
            'pan' => 'K...WCB7',
            'token' => 'EM2J8GZ3G8KAKA72VF30',
            'type' => 'ewallet'
        ])->getRepository(PaymentSource::class);

        $paymentSource = $repository->findByToken(
            'EM2J8GZ3G8KAKA72VF30',
            (string)\getenv('PAYMENTS_API_KEY')
        );

        self::assertInstanceOf(Ewallet::class, $paymentSource);
        self::assertSame(
            'EM2J8GZ3G8KAKA72VF30',
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
        $class = new Ewallet();
        self::assertIsArray($class->uris());
        self::assertCount(2, $class->uris());
    }
}
