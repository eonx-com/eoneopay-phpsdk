<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\ScheduledPayments\Ewallet;

use EoneoPay\PhpSdk\Requests\ScheduledPayments\AbstractPayRequest;
use EoneoPay\PhpSdk\Responses\Transactions\Ewallet;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class PayRequest extends AbstractPayRequest
{
    /**
     * @Assert\NotNull(groups={"pay"})
     * @Assert\Valid(groups={"pay"})
     *
     * @Groups({"pay"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Ewallet|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $ewallet;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return Ewallet::class;
    }
}
