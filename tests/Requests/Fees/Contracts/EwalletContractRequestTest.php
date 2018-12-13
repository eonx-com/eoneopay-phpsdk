<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Fees\Contracts;

use EoneoPay\PhpSdk\Requests\Fees\Contracts\EwalletContractRequest;
use EoneoPay\PhpSdk\Responses\Fee;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

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
            'variable' => '0.14',
            'currency' => 'AUD'
        ];

        $response = $this->createClient(\array_merge($data, [
            'group' => 'Ewallet',
            'type' => 'contract'
        ]))->create(new EwalletContractRequest($data));

        self::assertInstanceOf(Fee::class, $response);
        self::assertSame('Ewallet', $response->getGroup());
        self::assertSame('contract', $response->getType());
        self::assertSame($data['fixed'], $response->getFixed());
        self::assertSame($data['variable'], $response->getVariable());
        self::assertSame($data['currency'], $response->getCurrency());
    }
}
