<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\SchedulePayments;

use EoneoPay\PhpSdk\Requests\Payloads\BankAccount as BankAccountPayload;
use EoneoPay\PhpSdk\Responses\SchedulePayment;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method null|BankAccountPayload getBankAccount()
 */
class BankAccount extends SchedulePayment
{
    /**
     * Bank account endpoint.
     *
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create", "get", "list"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\BankAccount|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $bankAccount;
}
