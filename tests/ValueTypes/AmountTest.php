<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\ValueTypes;

use EoneoPay\PhpSdk\ValueTypes\Amount;
use Tests\EoneoPay\PhpSdk\TestCases\ValidationEnabledTestCase;

/**
 * @covers \EoneoPay\PhpSdk\ValueTypes\Amount
 */
class AmountTest extends ValidationEnabledTestCase
{
    /**
     * Test that passing in an array to the constructor populates the properties with the expected values.
     *
     * @return void
     */
    public function testConstructorFill(): void
    {
        $amount = new Amount([
            'currency' => 'AUD',
            'payment_fee' => '1.00',
            'subtotal' => '99.00',
            'total' => '100.00'
        ]);

        self::assertSame('AUD', $amount->getCurrency());
        self::assertSame('1.00', $amount->getPaymentFee());
        self::assertSame('99.00', $amount->getSubtotal());
        self::assertSame('100.00', $amount->getTotal());
    }

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
     * @param string $expected
     *
     * @dataProvider validatorScenarios
     *
     * @return void
     */
    public function testValidatorFailsWithInvalidData(Amount $amount, string $expected): void
    {
        $validator = $this->getValidator();
        $result = $validator->validate($amount);

        $this->assertConstraints($expected, $result);
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
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength) Long method required to define all scenarios.
     */
    public function validatorScenarios(): iterable
    {
        $amount = $this->createValidInstance();
        $amount->setCurrency('whatisthis');
        yield 'Currency over maximum' => [
            'amount' => $amount,
            'expected' => <<<ERR
Object(EoneoPay\PhpSdk\ValueTypes\Amount).currency:
    This value is not valid. (code de1e3db3-5ed4-4941-aae4-59f3667cc3a3)

ERR
        ];

        $amount = $this->createValidInstance();
        $amount->setCurrency('A23');
        yield 'Invalid currency' => [
            'amount' => $amount,
            'expected' => <<<ERR
Object(EoneoPay\PhpSdk\ValueTypes\Amount).currency:
    This value is not valid. (code de1e3db3-5ed4-4941-aae4-59f3667cc3a3)

ERR
        ];

        $amount = $this->createValidInstance();
        $amount->setPaymentFee('dsf987');
        yield 'Invalid payment fee' => [
            'amount' => $amount,
            'expected' => <<<ERR
Object(EoneoPay\PhpSdk\ValueTypes\Amount).paymentFee:
    This value should be a valid number. (code ad9a9798-7a99-4df7-8ce9-46e416a1e60b)
Object(EoneoPay\PhpSdk\ValueTypes\Amount).paymentFee:
    This value should be of type numeric. (code ba785a8c-82cb-4283-967c-3cf342181b40)

ERR
        ];

        $amount = $this->createValidInstance();
        $amount->setPaymentFee('-123.45');
        yield 'Payment fee negative' => [
            'amount' => $amount,
            'expected' => <<<ERR
Object(EoneoPay\PhpSdk\ValueTypes\Amount).paymentFee:
    This value should be 0.01 or more. (code 76454e69-502c-46c5-9643-f447d837c4d5)

ERR
        ];

        $amount = $this->createValidInstance();
        $amount->setPaymentFee('100000000.00');
        yield 'Payment fee over max' => [
            'amount' => $amount,
            'expected' => <<<ERR
Object(EoneoPay\PhpSdk\ValueTypes\Amount).paymentFee:
    This value should be 99999999.99 or less. (code 2d28afcb-e32e-45fb-a815-01c431a86a69)

ERR
        ];

        $amount = $this->createValidInstance();
        $amount->setSubtotal('abc123');
        yield 'Invalid subtotal' => [
            'amount' => $amount,
            'expected' => <<<ERR
Object(EoneoPay\PhpSdk\ValueTypes\Amount).subtotal:
    This value should be a valid number. (code ad9a9798-7a99-4df7-8ce9-46e416a1e60b)
Object(EoneoPay\PhpSdk\ValueTypes\Amount).subtotal:
    This value should be of type numeric. (code ba785a8c-82cb-4283-967c-3cf342181b40)

ERR
        ];

        $amount = $this->createValidInstance();
        $amount->setSubtotal('-123.45');
        yield 'Subtotal negative' => [
            'amount' => $amount,
            'expected' => <<<ERR
Object(EoneoPay\PhpSdk\ValueTypes\Amount).subtotal:
    This value should be 0.01 or more. (code 76454e69-502c-46c5-9643-f447d837c4d5)

ERR
        ];

        $amount = $this->createValidInstance();
        $amount->setSubtotal('100000000.00');
        yield 'Subtotal over max' => [
            'amount' => $amount,
            'expected' => <<<ERR
Object(EoneoPay\PhpSdk\ValueTypes\Amount).subtotal:
    This value should be 99999999.99 or less. (code 2d28afcb-e32e-45fb-a815-01c431a86a69)

ERR
        ];

        $amount = $this->createValidInstance();
        $amount->setTotal('abc123');
        yield 'Invalid total' => [
            'amount' => $amount,
            'expected' => <<<ERR
Object(EoneoPay\PhpSdk\ValueTypes\Amount).total:
    This value should be a valid number. (code ad9a9798-7a99-4df7-8ce9-46e416a1e60b)
Object(EoneoPay\PhpSdk\ValueTypes\Amount).total:
    This value should be of type numeric. (code ba785a8c-82cb-4283-967c-3cf342181b40)

ERR
        ];

        $amount = $this->createValidInstance();
        $amount->setTotal('-123.45');
        yield 'Total negative' => [
            'amount' => $amount,
            'expected' => <<<ERR
Object(EoneoPay\PhpSdk\ValueTypes\Amount).total:
    This value should be 0.01 or more. (code 76454e69-502c-46c5-9643-f447d837c4d5)

ERR
        ];

        $amount = $this->createValidInstance();
        $amount->setTotal('100000000.00');
        yield 'Total over max' => [
            'amount' => $amount,
            'expected' => <<<ERR
Object(EoneoPay\PhpSdk\ValueTypes\Amount).total:
    This value should be 99999999.99 or less. (code 2d28afcb-e32e-45fb-a815-01c431a86a69)

ERR
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
