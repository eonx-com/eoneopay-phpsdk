<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\ScheduledPayments\CreditCard;

use EoneoPay\PhpSdk\Requests\ScheduledPayments\AbstractPayRequest;
use EoneoPay\PhpSdk\Responses\Transactions\CreditCard;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class PayRequest extends AbstractPayRequest
{
    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCard|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $creditCard;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return CreditCard::class;
    }
}
