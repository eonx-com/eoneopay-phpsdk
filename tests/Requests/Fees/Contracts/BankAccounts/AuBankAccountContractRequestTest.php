<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Fees\Contracts\BankAccounts;

use EoneoPay\PhpSdk\Interfaces\Requests\Fees\ContractRequestInterface;
use EoneoPay\PhpSdk\Requests\Fees\Contracts\BankAccounts\AuBankAccountContractRequest;
use EoneoPay\PhpSdk\Responses\Fee;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Fees\Contracts\BankAccounts\AuBankAccountContractRequest
 */
class AuBankAccountContractRequestTest extends RequestTestCase
{
    /**
     * Test create bank account contract fee successfully.
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
            'group' => ContractRequestInterface::GROUP_BANK_ACCOUNT,
            'type' => 'contract'
        ]))->create(new AuBankAccountContractRequest($data));

        self::assertInstanceOf(Fee::class, $response);
        self::assertSame(ContractRequestInterface::GROUP_BANK_ACCOUNT, $response->getGroup());
        self::assertSame('contract', $response->getType());
        self::assertSame($data['fixed'], $response->getFixed());
        self::assertSame($data['variable'], $response->getVariable());
        self::assertSame($data['currency'], $response->getCurrency());
    }
}
