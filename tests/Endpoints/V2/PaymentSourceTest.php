<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Endpoints\V2\PaymentSource;
use EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\BankAccount;
use EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Bpay;
use EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\CreditCard;
use EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Ewallet;
use EoneoPay\PhpSdk\Endpoints\V2\Transaction;
use EoneoPay\PhpSdk\Endpoints\V2\User;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\PaymentSource
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Ewallet
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\CreditCard
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\BankAccount
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Bpay
 */
class PaymentSourceTest extends TransactionTestCase
{
    /**
     * Tests bank account getters.
     *
     * @return void
     */
    public function testBankAccountGetters(): void
    {
        $bankAccount = new BankAccount([
            'country' => 'AU',
            'name' => 'User Name',
            'number' => '987654321',
            'prefix' => '123456',
            'type' => 'bank_account',
        ]);

        self::assertSame('AU', $bankAccount->getCountry());
        self::assertSame('User Name', $bankAccount->getName());
        self::assertSame('987654321', $bankAccount->getNumber());
        self::assertSame('123456', $bankAccount->getPrefix());
        self::assertSame('bank_account', $bankAccount->getType());
    }

    /**
     * Tests V2 bpay creation and getters.
     *
     * @return void
     */
    public function testBpayGetters(): void
    {
        $paymentSource = new Bpay([
            'id' => '123',
            'pan' => 'B...PAY',
            'biller_code' => '112233',
            'biller_name' => 'Test',
            'reference_number' => '1793768381',
        ]);

        self::assertSame('123', $paymentSource->getId());
        self::assertSame('B...PAY', $paymentSource->getPan());
        self::assertSame('112233', $paymentSource->getBillerCode());
        self::assertSame('Test', $paymentSource->getBillerName());
        self::assertSame('1793768381', $paymentSource->getReferenceNumber());
    }

    /**
     * Tests credit card payment source getters.
     *
     * @return void
     */
    public function testCreditCardCreationAndGetters(): void
    {
        $bin = [
            'bin' => '512345',
            'category' => 'Standard',
            'country' => 'EC',
            'created_at' => '2019-02-13T22=>10=>24Z',
            'funding_source' => 'CREDIT',
            'issuer' => 'BANCO DEL PICHINCHA, C.A.',
            'prepaid' => null,
            'scheme' => 'MASTERCARD',
            'updated_at' => '2019-02-13T22=>10=>24Z',
        ];
        $creditCard = new CreditCard([
            'bin' => $bin,
            'expiry' => [
                'month' => '11',
                'year' => '2099',
            ],
            'facility' => 'Mastercard',
            'type' => 'credit_card'
        ]);

        self::assertSame('Mastercard', $creditCard->getFacility());
        self::assertSame($bin, $creditCard->getBin());
        self::assertSame(
            ['month' => '11', 'year' => '2099'],
            $creditCard->getExpiry()
        );
        self::assertSame('credit_card', $creditCard->getType());
    }

    /**
     * Tests V2 ewallet creation and getters.
     *
     * @return void
     */
    public function testEwalletGetters(): void
    {
        $balances = [
            'available' => '123.45',
            'balance' => '234.56',
            'credit_limit' => '0.00',
        ];
        $user = [
            'created_at' => '2019-02-22T03=>09=>44Z',
            'email' => 'example@user.test',
            'updated_at' => '2019-02-22T03=>09=>44Z',
        ];

        $request = [
            'paymentSource' => [
                'created_at' => '2019-02-26T00=>14=>25Z',
                'balances' => $balances,
                'id' => 'dad99a43563c72a19a99aae4b1605b49',
                'pan' => 'W...J3X7',
                'primary' => false,
                'reference' => 'WCMKZAJ3X7',
                'type' => 'ewallet',
                'updated_at' => '2019-02-26T00=>14=>25Z',
                'user' => $user,
            ]
        ];

        /**
         * @var \EoneoPay\PhpSdk\Endpoints\V2\Transaction $actual
         */
        $actual = $this->createApiManager($request)
            ->create((string)\getenv('PAYMENTS_API_KEY'), new Transaction());

        $ewallet = $actual->getPaymentSource();
        self::assertInstanceOf(Ewallet::class, $ewallet);
        /**
         * @var \EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Ewallet $ewallet
         */
        self::assertSame('dad99a43563c72a19a99aae4b1605b49', $ewallet->getId());
        self::assertSame('ewallet', $ewallet->getType());
        self::assertEquals(new User($user), $ewallet->getUser());
    }

    /**
     * Tests uri's.
     *
     * @return void
     */
    public function testUris(): void
    {
        $paymentSource = new PaymentSource();

        self::assertSame([], $paymentSource->uris());
    }
}
