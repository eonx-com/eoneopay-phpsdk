<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\ValueTypes;

use EoneoPay\PhpSdk\ValueTypes\Amount;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\ValueTypes\Amount
 */
class AmountTest extends TestCase
{
    /**
     * Tests the class setters and getters to ensure the expected values are received once set and
     * formatted.
     *
     * @return void
     */
    public function testSetterGetter(): void
    {
        $amount = new Amount();
        $amount->setCurrency('AUD');
        $amount->setPaymentFee('1.00');
        $amount->setSubtotal('99.00');
        $amount->setTotal('100.00');

        self::assertSame('AUD', $amount->getCurrency());
        self::assertSame('1.00', $amount->getPaymentFee());
        self::assertSame('99.00', $amount->getSubtotal());
        self::assertSame('100.00', $amount->getTotal());
    }

    /**
     * Tests that the validator fails under all provided scenarios.
     *
     * @param \EoneoPay\PhpSdk\ValueTypes\Amount $amount
     * @param \Symfony\Component\Validator\ConstraintViolation[] $violations
     *
     * @dataProvider validatorScenarios
     *
     * @return void
     */
    public function testValidatorFailsWithInvalidData(Amount $amount, array $violations): void
    {
        $validator = $this->getValidator();
        $result = $validator->validate($amount);

        self::assertEquals($violations, $result);
    }

    /**
     * Tests that the validator returns no violations when the data provided to the Amount value type is valid.
     *
     * @return void
     */
    public function testValidatorSuccessfulWithValidData(): void
    {
        $amount = $this->createValidInstance();
        $validator = $this->getValidator();
        $violations = $validator->validate($amount);

        self::assertCount(0, $violations);
    }

    /**
     * Gets data scenarios for the validator test.
     *
     * @return mixed[]
     */
    public function validatorScenarios(): iterable
    {
        $amount = $this->createValidInstance();
        $amount->setCurrency('whatisthis');
        yield 'Invalid currency' => [
            $amount,
            []
        ];

        $amount = $this->createValidInstance();
        $amount->setPaymentFee('dsf987');
        yield 'Invalid payment fee' => [
            $amount,
            []
        ];
    }

    /**
     * Creates a valid instance of the Amount value type class.
     *
     * @return \EoneoPay\PhpSdk\ValueTypes\Amount
     */
    private function createValidInstance(): Amount
    {
        $amount = new Amount();
        $amount->setCurrency('AUD');
        $amount->setPaymentFee('1.00');
        $amount->setSubtotal('99.00');
        $amount->setTotal('100.00');

        return $amount;
    }
}
