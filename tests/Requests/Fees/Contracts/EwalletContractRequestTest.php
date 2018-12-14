<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Fees\Contracts;

use EoneoPay\PhpSdk\Interfaces\Requests\Fees\ContractRequestInterface;
use EoneoPay\PhpSdk\Requests\Fees\Contracts\EwalletContractRequest;
use EoneoPay\PhpSdk\Responses\Fee;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * Class EwalletContractRequestTest
 *
 * @package Tests\EoneoPay\PhpSdk\Requests\Fees\Contracts
 */
class EwalletContractRequestTest extends RequestTestCase
{
    /**
     * Test create ewallet fee contract successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testCreateSuccessfully(): void
    {
        $data = [
            'fixed' => '0.02',
            'group' => ContractRequestInterface::GROUP_EWALLET,
            'variable' => '0.14',
            'currency' => 'AUD'
        ];

        $response = $this->createClient(\array_merge($data, [
            'type' => 'contract'
        ]))->create(new EwalletContractRequest($data));


        self::assertInstanceOf(Fee::class, $response);
        self::assertSame(ContractRequestInterface::GROUP_EWALLET, $response->getGroup());
        self::assertSame('contract', $response->getType());
        self::assertSame($data['fixed'], $response->getFixed());
        self::assertSame($data['variable'], $response->getVariable());
        self::assertSame($data['currency'], $response->getCurrency());
    }
}
