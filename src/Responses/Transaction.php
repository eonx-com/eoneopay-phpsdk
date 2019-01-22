<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\Ewallet;
use EoneoPay\PhpSdk\Traits\TransactionTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method null|Amount getAmount()
 * @method null|BankAccount getBankAccount()
 * @method null|CreditCard getCreditCard()
 * @method null|Ewallet getEwallet()
 * @method null|bool getApproved()
 * @method null|string getCompletedAt()
 * @method null|string getId()
 * @method null|AbstractResponse getResponse()
 * @method null|string getStatus()
 */
abstract class Transaction extends AbstractResponse
{
    use TransactionTrait;

    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create", "update", "delete"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Amount
     */
    protected $amount;

    /**
     * @Groups({"create", "update"})
     *
     * @var null|\EoneoPay\PhpSdk\Responses\Transactions\Response
     */
    protected $response;
}
