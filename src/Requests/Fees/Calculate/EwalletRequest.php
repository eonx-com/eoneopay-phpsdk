<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Fees\Calculate;

use EoneoPay\PhpSdk\Responses\Fees\Calculate\EwalletFee;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class EwalletRequest extends CalculateRequest
{
    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Ewallet|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $ewallet;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return EwalletFee::class;
    }
}
