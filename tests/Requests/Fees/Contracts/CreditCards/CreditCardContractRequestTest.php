<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards;

use EoneoPay\PhpSdk\Interfaces\Requests\Fees\ContractRequestInterface;
use EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\AmericanExpressContractRequest;
use EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\DinersClubContractRequest;
use EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\DiscoverContractRequest;
use EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\JcbContractRequest;
use EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\MastercardContractRequest;
use EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\UnionPayContractRequest;
use EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\VisaContractRequest;
use EoneoPay\PhpSdk\Responses\Fee;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class CreditCardContractRequestTest extends RequestTestCase
{
    /**
     * Test create American Express contract fee.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testAmericanExpressContractCreate(): void
    {
        $response = $this->createClient(\array_merge(
            $this->getFeeRequestData(),
            [
                'group' => ContractRequestInterface::GROUP_CREDIT_CARD_AMERICAN_EXPRESS,
                'type' => 'contract'
            ]
        ))->create(new AmericanExpressContractRequest($this->getFeeRequestData()));

        self::assertInstanceOf(Fee::class, $response);
        $this->assertions(ContractRequestInterface::GROUP_CREDIT_CARD_AMERICAN_EXPRESS, $response);
    }

    /**
     * Test create Bank Account contract fee.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testBankAccountContractCreate(): void
    {
        $response = $this->createClient(\array_merge(
            $this->getFeeRequestData(),
            [
                'group' => ContractRequestInterface::GROUP_BANK_ACCOUNT,
                'type' => 'contract'
            ]
        ))->create(new DinersClubContractRequest($this->getFeeRequestData()));

        self::assertInstanceOf(Fee::class, $response);
        $this->assertions(ContractRequestInterface::GROUP_BANK_ACCOUNT, $response);
    }

    /**
     * Test create Diners Club contract fee.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testDinersClubContractCreate(): void
    {
        $response = $this->createClient(\array_merge(
            $this->getFeeRequestData(),
            [
                'group' => ContractRequestInterface::GROUP_CREDIT_CARD_DINERS_CLUB,
                'type' => 'contract'
            ]
        ))->create(new DinersClubContractRequest($this->getFeeRequestData()));

        self::assertInstanceOf(Fee::class, $response);
        $this->assertions(ContractRequestInterface::GROUP_CREDIT_CARD_DINERS_CLUB, $response);
    }

    /**
     * Test create Discover contract fee.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testDiscoverContractCreate(): void
    {
        $response = $this->createClient(\array_merge(
            $this->getFeeRequestData(),
            [
                'group' => ContractRequestInterface::GROUP_CREDIT_CARD_DISCOVER,
                'type' => 'contract'
            ]
        ))->create(new DiscoverContractRequest($this->getFeeRequestData()));

        self::assertInstanceOf(Fee::class, $response);
        $this->assertions(ContractRequestInterface::GROUP_CREDIT_CARD_DISCOVER, $response);
    }

    /**
     * Test create Ewallet contract fee.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testEwalletContractCreate(): void
    {
        $response = $this->createClient(\array_merge(
            $this->getFeeRequestData(),
            [
                'group' => ContractRequestInterface::GROUP_EWALLET,
                'type' => 'contract'
            ]
        ))->create(new DinersClubContractRequest($this->getFeeRequestData()));

        self::assertInstanceOf(Fee::class, $response);
        $this->assertions(ContractRequestInterface::GROUP_EWALLET, $response);
    }

    /**
     * Test create JCB contract fee.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testJcbContractCreate(): void
    {
        $response = $this->createClient(\array_merge(
            $this->getFeeRequestData(),
            [
                'group' => ContractRequestInterface::GROUP_CREDIT_CARD_JCB,
                'type' => 'contract'
            ]
        ))->create(new JcbContractRequest($this->getFeeRequestData()));

        self::assertInstanceOf(Fee::class, $response);
        $this->assertions(ContractRequestInterface::GROUP_CREDIT_CARD_JCB, $response);
    }

    /**
     * Test create Mastercard contract fee.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testMastercardContractCreate(): void
    {
        $response = $this->createClient(\array_merge(
            $this->getFeeRequestData(),
            [
                'group' => ContractRequestInterface::GROUP_CREDIT_CARD_MASTERCARD,
                'type' => 'contract'
            ]
        ))->create(new MastercardContractRequest($this->getFeeRequestData()));

        self::assertInstanceOf(Fee::class, $response);
        $this->assertions(ContractRequestInterface::GROUP_CREDIT_CARD_MASTERCARD, $response);
    }

    /**
     * Test create UnionPay contract fee.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testUnionPayContractCreate(): void
    {
        $response = $this->createClient(\array_merge(
            $this->getFeeRequestData(),
            [
                'group' => ContractRequestInterface::GROUP_CREDIT_CARD_UNIONPAY,
                'type' => 'contract'
            ]
        ))->create(new UnionPayContractRequest($this->getFeeRequestData()));

        self::assertInstanceOf(Fee::class, $response);
        $this->assertions(ContractRequestInterface::GROUP_CREDIT_CARD_UNIONPAY, $response);
    }

    /**
     * Test create Visa contract fee.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testVisaContractCreate(): void
    {
        $response = $this->createClient(\array_merge(
            $this->getFeeRequestData(),
            [
                'group' => ContractRequestInterface::GROUP_CREDIT_CARD_VISA,
                'type' => 'contract'
            ]
        ))->create(new VisaContractRequest($this->getFeeRequestData()));

        self::assertInstanceOf(Fee::class, $response);
        $this->assertions(ContractRequestInterface::GROUP_CREDIT_CARD_VISA, $response);
    }

    /**
     * Perform assertions.
     *
     * @param string $group Endpoint group
     * @param \EoneoPay\PhpSdk\Responses\Fee $response Fee response object
     *
     * @return void
     */
    private function assertions(string $group, Fee $response): void
    {
        $data = $this->getFeeRequestData();

        self::assertSame('contract', $response->getType());
        self::assertSame($group, $response->getGroup());
        self::assertSame($data['currency'], $response->getCurrency());
        self::assertSame($data['fixed'], $response->getFixed());
        self::assertSame($data['variable'], $response->getVariable());
    }

    /**
     * Get contract request data.
     *
     * @return mixed[]
     */
    private function getFeeRequestData(): array
    {
        return [
            'fixed' => '0.02',
            'variable' => '0.14',
            'currency' => 'AUD'
        ];
    }
}
