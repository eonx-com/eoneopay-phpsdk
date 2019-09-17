<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSource
 * @covers \EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard
 */
final class CreditCardTest extends TestCase
{
    /**
     * Test if credit card token is created successfully.
     *
     * @return void
     */
    public function testCreateCreditCardToken(): void
    {
        $creditCard = new CreditCard(
            [
                'expiry' => [
                    'month' => '11',
                    'year' => '2099',
                ],
                'name' => 'User Name',
                'number' => '5123450000000008',
                'type' => 'credit_card',
            ]
        );
        $actual = $this->createApiManager(
            [
                'bin' => [
                    'bin' => '512345',
                    'category' => 'Standard',
                    'country' => 'EC',
                    'created_at' => '2019-02-13T22=>10=>24Z',
                    'funding_source' => 'CREDIT',
                    'issuer' => 'BANCO DEL PICHINCHA, C.A.',
                    'prepaid' => null,
                    'scheme' => 'MASTERCARD',
                    'updated_at' => '2019-02-13T22=>10=>24Z',
                ],
                'created_at' => '2019-02-22T03=>08=>07Z',
                'expiry' => [
                    'month' => '11',
                    'year' => '2099',
                ],
                'facility' => 'Mastercard',
                'id' => '1a05c6ac43c7a93088a7bff15e3625f4',
                'name' => 'User Name',
                'pan' => '512345...0008',
                'token' => 'BBEJ6JGRHAZ2KUBD89C3',
                'type' => 'credit_card',
                'updated_at' => '2019-02-22T03=>08=>13Z',
            ]
        )->create('4UM78RDZW93B84UJ', $creditCard);

        self::assertInstanceOf(CreditCard::class, $actual);
        self::assertIsString(($actual instanceof CreditCard) ? $actual->getToken() : null);
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
            'type' => 'credit_card',
        ])->getRepository(PaymentSource::class);

        $paymentSource = $repository->findByToken(
            'VRG2VR4F39343HM4D3N2',
            (string)\getenv('PAYMENTS_API_KEY')
        );

        self::assertInstanceOf(CreditCard::class, $paymentSource);
        self::assertSame(
            'VRG2VR4F39343HM4D3N2',
            ($paymentSource instanceof PaymentSource) === true ? $paymentSource->getToken() : null
        );
    }

    /**
     * Test if uri is created.
     *
     * @return void
     */
    public function testUriIsCreated(): void
    {
        $class = new CreditCard();
        self::assertIsArray($class->uris());
        self::assertCount(3, $class->uris());
    }
}
