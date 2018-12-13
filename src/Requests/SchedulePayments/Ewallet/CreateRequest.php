<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\SchedulePayments\Ewallet;

use EoneoPay\PhpSdk\Requests\SchedulePayments\SchedulePaymentRequest;
use EoneoPay\PhpSdk\Responses\SchedulePayments\Ewallet;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CreateRequest extends SchedulePaymentRequest
{
    /**
     * Ewallet endpoint.
     *
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
        return Ewallet::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/schedules/%s', $this->id)
        ];
    }
}
