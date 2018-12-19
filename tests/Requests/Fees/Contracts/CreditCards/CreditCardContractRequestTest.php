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
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\AmericanExpressContractRequest
 * @covers \EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\DinersClubContractRequest
 * @covers \EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\DiscoverContractRequest
 * @covers \EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\JcbContractRequest
 * @covers \EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\MastercardContractRequest
 * @covers \EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\UnionPayContractRequest
 * @covers \EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards\VisaContractRequest
 */
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
        $request = $this->getFeeRequestData(ContractRequestInterface::GROUP_CREDIT_CARD_AMERICAN_EXPRESS);

        $response = $this->createClient(\array_merge($request, ['type' => 'contract']))->create(
            new AmericanExpressContractRequest($request)
        );

        self::assertInstanceOf(Fee::class, $response);
        $this->assertions(ContractRequestInterface::GROUP_CREDIT_CARD_AMERICAN_EXPRESS, $response);
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
        $request = $this->getFeeRequestData(ContractRequestInterface::GROUP_CREDIT_CARD_DINERS_CLUB);

        $response = $this->createClient(\array_merge($request, ['type' => 'contract']))->create(
            new DinersClubContractRequest($request)
        );

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
        $request = $this->getFeeRequestData(ContractRequestInterface::GROUP_CREDIT_CARD_DISCOVER);

        $response = $this->createClient(\array_merge($request, ['type' => 'contract']))->create(
            new DiscoverContractRequest($request)
        );

        self::assertInstanceOf(Fee::class, $response);
        $this->assertions(ContractRequestInterface::GROUP_CREDIT_CARD_DISCOVER, $response);
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
        $request = $this->getFeeRequestData(ContractRequestInterface::GROUP_CREDIT_CARD_JCB);

        $response = $this->createClient(\array_merge($request, ['type' => 'contract']))->create(
            new JcbContractRequest($request)
        );

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
        $request = $this->getFeeRequestData(ContractRequestInterface::GROUP_CREDIT_CARD_MASTERCARD);

        $response = $this->createClient(\array_merge($request, ['type' => 'contract']))->create(
            new MastercardContractRequest($request)
        );

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
        $request = $this->getFeeRequestData(ContractRequestInterface::GROUP_CREDIT_CARD_UNIONPAY);

        $response = $this->createClient(\array_merge($request, ['type' => 'contract']))->create(
            new UnionPayContractRequest($request)
        );

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
        $request = $this->getFeeRequestData(ContractRequestInterface::GROUP_CREDIT_CARD_VISA);

        $response = $this->createClient(\array_merge($request, ['type' => 'contract']))->create(
            new VisaContractRequest($request)
        );

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
     * @param null|string $group Credit card group
     *
     * @return mixed[]
     */
    private function getFeeRequestData(?string $group = null): array
    {
        $data = [];

        if ($group !== null) {
            $data = \array_merge($data, ['group' => $group]);
        }

        return \array_merge([
            'fixed' => '0.02',
            'variable' => '0.14',
            'currency' => 'AUD'
        ], $data);
    }
}
