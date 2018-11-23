<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\Ewallets;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Transaction;
use EoneoPay\PhpSdk\Traits\TransactionTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

abstract class EwalletTransactionRequest extends AbstractRequest
{
    use TransactionTrait;

    /**
     * @Assert\NotNull(groups={"create", "update", "delete"})
     * @Assert\Valid(groups={"create", "update", "delete"})
     *
     * @Groups({"create", "update", "delete"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Amount
     */
    protected $amount;

    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Ewallet|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $ewallet;

    /**
     * @inheritdoc
     */
    public function expectObject(): string
    {
        return Transaction::class;
    }
}
