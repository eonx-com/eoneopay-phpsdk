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
 *     "ewallet" = "EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Ewallet"
 * })
 */
class PaymentSource extends V1PaymentSource
{
}
