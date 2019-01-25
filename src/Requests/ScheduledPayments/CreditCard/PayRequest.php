<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\ScheduledPayments\CreditCard;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Transactions\CreditCard;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class PayRequest extends AbstractRequest
{
    /**
     * Payment id
     *
     * @Assert\NotBlank(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $paymentId;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return CreditCard::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/schedules/%s/pay', $this->paymentId)
        ];
    }
}
