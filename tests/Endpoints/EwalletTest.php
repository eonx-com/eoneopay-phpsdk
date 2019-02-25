<?php
/**
 * Created by PhpStorm.
 * User: Codeint
 * Date: 25/02/2019
 * Time: 13:58
 */

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\Ewallet;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Ewallet
 */
class EwalletTest extends TestCase
{
    /**
     * Test Ewallet details are returned back
     *
     * @return void
     */
    public function testEwalletBalance(): void
    {
        $response = [
            'balances' => [
                'available' => '0.00',
                'balance' => '0.00'
            ],
            'created_at' => '2019-02-25T02=>40=>32Z',
            'currency' => 'AUD',
            'id' => '6524e7d900805b9de1cc91d4864988ec',
            'pan' => 'J...ZAR0',
            'primary' => false,
            'reference' => 'JEKYYFZAR0',
            'type' => 'ewallet',
            'updated_at' => '2019-02-25T02=>40=>32Z',
            'user' => [
                'created_at' => '2019-02-22T03=>09=>44Z',
                'email' => 'example@user.test',
                'updated_at' => '2019-02-22T03=>09=>44Z'
            ]
        ];
        
        $ewallet = $this->createApiManager($response, 200)
            ->findOneBy(
                Ewallet::class,
                $this->getApiKey(),
                ['reference' => 'JEKYYFZAR0']
            );

        self::assertSame('JEKYYFZAR0', $ewallet->getReference());
        // check if it has balances
        self::assertObjectHasAttribute('balances', $ewallet);
    }

    /**
     * Test creation of ewallet
     *
     * @return void
     */
    public function testEwalletCreation(): void
    {

        $id = $this->generateId();
        $ewallet = $this->createApiManager([
            'currency' => 'AUD',
            'id' => $id,
            'pan' => 'G...2T89',
            'primary' => false,
            'reference' => 'GEHBB72T89',
            'type' => 'ewallet'
        ])->create((string)\getenv('PAYMENTS_API_KEY'), new Ewallet());

        self::assertIsString($ewallet->getId());
        self::assertNotEmpty($ewallet->getType());
    }

    /**
     * Test if exception code is covered
     *
     * @return void
     */
    public function testExceptionIsThrownOnEwalletCreationWithWrongKey(): void
    {
        $this->expectException(InvalidApiResponseException::class);
        $this->createApiManager([
            'code' => 4401,
            'message' => 'Unauthorised.',
            'sub_code' => 1,
            'time' => '2019-02-25T02=>31=>59Z'
        ], 401)->create('wrong_key', new Ewallet());
    }

    /**
     * Test to check if Uri has been entered
     *
     * @return void
     */
    public function testUriIsCreated(): void
    {
        $ewallet = new Ewallet();
        self::assertCount(2, $ewallet->uris());
    }
}
