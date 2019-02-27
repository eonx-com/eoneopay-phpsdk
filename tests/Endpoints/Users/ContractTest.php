<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\Ewallet;
use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Endpoints\Users\Contract;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Users\Contract
 */
class ContractTest extends TestCase
{
    /**
     * Test contract fees create or update
     *
     * @return void
     */
    public function testCreateContractFees(): void
    {
        $contract = $this->createApiManager(
            [
                'created_at' => '2019-02-25T05=>43=>31Z',
                'currency' => 'AUD',
                'ewallet' => [
                    'created_at' => '2019-02-24T23=>34=>11Z',
                    'currency' => 'AUD',
                    'id' => '6e967a8e9971aab24d2db4e932ca1a06',
                    'pan' => 'Y...K8Y7',
                    'primary' => true,
                    'reference' => 'YNGANFK8Y7',
                    'type' => 'ewallet',
                    'updated_at' => '2019-02-24T23=>34=>11Z',
                    'user' => [
                        'created_at' => '2019-02-24T23=>34=>11Z',
                        'email' => 'examples@user.test',
                        'updated_at' => '2019-02-24T23=>34=>11Z'
                    ]
                ],
                'fixed_fee' => '0.02',
                'group' => 'Mastercard',
                'type' => 'contract',
                'updated_at' => '2019-02-26T03=>19=>03Z',
                'user' => [
                    'created_at' => '2019-02-24T23=>34=>11Z',
                    'email' => 'examples@user.test',
                    'updated_at' => '2019-02-24T23=>34=>11Z'
                ],
                'variable_rate' => '0.10'
            ],
            200
        )->create((string)\getenv('PAYMENTS_API_KEY'), new Contract(
            [
                'group' => 'mastercard',
                'currency' => 'AUD',
                'fixed_fee' => '0.02',
                'variable_rate' => '0.10',
                'user' => new User(['id' => 'external-user-id'])
            ]
        ));

        self::assertInstanceOf(Ewallet::class, ($contract instanceof Contract) ? $contract->getEwallet() : null);
    }
}
