<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait FeesTrait
{
    /**
     * Transaction action type
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $action;

    /**
     * Amount fees are based off
     *
     * @Groups({"create"})
     *
     * @var mixed[]|null
     */
    protected $amount;

    /**
     * Calculated amount of transaction that is fees
     *
     * @var string
     */
    protected $calculatedAmount;

    /**
     * @var string
     */
    protected $chargableAmount;

    /**
     * Fixed amount of cents
     *
     * @var string|null
     */
    protected $fixedFee;

    /**
     * Parent fee
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Fees
     */
    protected $parent;

    /**
     * Destination endpoint
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentDestination;

    /**
     * Source endpoint
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentSource;

    /**
     * Transaction this fee is associated to
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Transaction
     */
    protected $transaction;

    /**
     * Transaction of the resulting fees transfer
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Transaction
     */
    protected $transfer;

    /**
     * Fee type
     *
     * @var string|null
     */
    protected $type;

    /**
     * The variable amount (percentage) to calculate
     *
     * @var string|null
     */
    protected $variableRate;
}
