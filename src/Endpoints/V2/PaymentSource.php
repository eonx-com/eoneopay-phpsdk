<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Endpoints\V1\PaymentSource as V1PaymentSource;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @DiscriminatorMap(typeProperty="type", mapping={
 *     "bank_account" = "EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\BankAccount",
 *     "bpay" = "EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Bpay",
 *     "credit_card" = "EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\CreditCard",
 *     "ewallet" = "EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Ewallet",
 *     "points" = "EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Points"
 * })
 */
class PaymentSource extends V1PaymentSource
{
    /**
     * Transaction amount.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\V2\Amount|null
     */
    protected $amount;

    /**
     * Get amount.
     *
     * **NOTE** Only used for split payments.
     *
     * @return \EoneoPay\PhpSdk\Endpoints\V2\Amount|null
     */
    public function getAmount(): ?Amount
    {
        return $this->amount;
    }
}
