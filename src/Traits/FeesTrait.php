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
     * Destination endpoint
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentDestination;

    /**
     * Source endpoint
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentSource;
}
