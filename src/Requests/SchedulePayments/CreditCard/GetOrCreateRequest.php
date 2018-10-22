<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\SchedulePayments\CreditCard;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\SchedulePayment;
use EoneoPay\PhpSdk\Traits\SchedulePaymentTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class GetOrCreateRequest extends AbstractRequest
{
    use SchedulePaymentTrait;

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
    public function expectObject(): string
    {
        return SchedulePayment::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/schedule',
            self::GET => \sprintf('/schedule/%s', $this->id)
        ];
    }
}
