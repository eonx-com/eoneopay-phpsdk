<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Fees;

use EoneoPay\PhpSdk\Responses\Fees\CreditCardFee;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CreditCardRequest extends FeeRequest
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
        return CreditCardFee::class;
    }
}
