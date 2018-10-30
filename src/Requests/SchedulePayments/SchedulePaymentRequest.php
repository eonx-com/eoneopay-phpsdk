<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\SchedulePayments;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\SchedulePayment;
use EoneoPay\PhpSdk\Traits\SchedulePaymentTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

abstract class SchedulePaymentRequest extends AbstractRequest
{
    use SchedulePaymentTrait;

    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create", "delete"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Amount
     */
    protected $amount;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return SchedulePayment::class;
    }
}
