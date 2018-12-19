<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Transactions;

use EoneoPay\PhpSdk\Requests\Payloads\Ewallet as EwalletPayload;
use EoneoPay\PhpSdk\Responses\Transaction;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method null|EwalletPayload getEwallet()
 */
class Ewallet extends Transaction
{
    /**
     * Ewallet endpoint.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Ewallet
     */
    protected $ewallet;
}
