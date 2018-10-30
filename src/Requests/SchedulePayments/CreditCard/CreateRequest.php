<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\SchedulePayments\CreditCard;

use EoneoPay\PhpSdk\Requests\SchedulePayments\SchedulePaymentRequest;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CreateRequest extends SchedulePaymentRequest
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
    public function uris(): array
    {
        return [
            self::CREATE => '/schedule'
        ];
    }
}
