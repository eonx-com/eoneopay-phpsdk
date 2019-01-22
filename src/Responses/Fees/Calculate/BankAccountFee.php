<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Fees\Calculate;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Responses\AbstractResponse;
use EoneoPay\PhpSdk\Traits\Requests\Calculate\FeeTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method null|string getAction()
 * @method null|Amount getAmount()
 * @method null|BankAccount getBankAccount()
 */
class BankAccountFee extends AbstractResponse
{
    use FeeTrait;

    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\BankAccount|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $bankAccount;
}
