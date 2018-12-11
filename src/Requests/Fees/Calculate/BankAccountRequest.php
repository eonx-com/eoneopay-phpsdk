<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Fees\Calculate;

use EoneoPay\PhpSdk\Responses\Fees\Calculate\BankAccountFee;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class BankAccountRequest extends CalculateRequest
{
    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\BankAccount|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $bankAccount;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return BankAccountFee::class;
    }
}
