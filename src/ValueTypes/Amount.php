<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\ValueTypes;

class Amount
{
    /**
     * The currency code.
     *
     * @var string
     */
    protected $currency;

    /**
     * The fee amount.
     *
     * @var string
     */
    protected $paymentFee;

    /**
     * The net amount.
     *
     * @var string
     */
    protected $subtotal;

    /**
     * The gross amount.
     *
     * @var string
     */
    protected $total;

    /**
     * Gets the currency code.
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Gets the payment fee amount.
     *
     * @return string
     */
    public function getPaymentFee(): string
    {
        return $this->paymentFee;
    }

    /**
     * Sets the payment fee amount.
     *
     * @return string
     */
    public function getSubtotal(): string
    {
        return $this->subtotal;
    }

    /**
     * Gets the total amount.
     *
     * @return string
     */
    public function getTotal(): string
    {
        return $this->total;
    }

    /**
     * Sets the currency code.
     *
     * @param string $currency
     *
     * @return void
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * Sets the payment fee amount.
     *
     * @param string $paymentFee
     *
     * @return void
     */
    public function setPaymentFee(string $paymentFee): void
    {
        $this->paymentFee = $paymentFee;
    }

    /**
     * Sets the subtotal amount.
     *
     * @param string $subtotal
     *
     * @return void
     */
    public function setSubtotal(string $subtotal): void
    {
        $this->subtotal = $subtotal;
    }

    /**
     * Sets the total amount.
     *
     * @param string $total
     *
     * @return void
     */
    public function setTotal(string $total): void
    {
        $this->total = $total;
    }
}
