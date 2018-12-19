<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Transactions;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard as CreditCardPayload;
use EoneoPay\PhpSdk\Responses\Transaction;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method null|CreditCardPayload getCreditCard()
 */
class CreditCard extends Transaction
{
    /**
     * Credit card endpoint.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCard
     */
    protected $creditCard;
}
