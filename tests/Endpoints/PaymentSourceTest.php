<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSource
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet
 */
class PaymentSourceTest extends TestCase
{
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
            'api-key'
        );

        self::assertInstanceOf(BankAccount::class, $paymentSource);
        self::assertSame(
            '3T93F7TXCVGX4ZV7AFW2',
            ($paymentSource instanceof PaymentSource) === true ? $paymentSource->getToken() : null
        );
    }

    /**
     * Test that get token information will return credit card payment source.
     *
     * @return void
     */
    public function testGetCreditCardTokenInfoSuccessfully(): void
    {
        /** @var \EoneoPay\PhpSdk\Repositories\PaymentSourceRepository $repository */
        $repository = $this->createApiManager([
            'id' => $this->generateId(),
            'name' => 'John Wick',
            'pan' => '512345...0008',
            'token' => 'VRG2VR4F39343HM4D3N2',
            'type' => 'credit_card'
        ])->getRepository(PaymentSource::class);

        $paymentSource = $repository->findByToken(
            'VRG2VR4F39343HM4D3N2',
            'api-key'
        );

        self::assertInstanceOf(CreditCard::class, $paymentSource);
        self::assertSame(
            'VRG2VR4F39343HM4D3N2',
            ($paymentSource instanceof PaymentSource) === true ? $paymentSource->getToken() : null
        );
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
            'api-key'
        );

        self::assertInstanceOf(Ewallet::class, $paymentSource);
        self::assertSame(
            'EM2J8GZ3G8KAKA72VF30',
            ($paymentSource instanceof PaymentSource) === true ? $paymentSource->getToken() : null
        );
    }
}
