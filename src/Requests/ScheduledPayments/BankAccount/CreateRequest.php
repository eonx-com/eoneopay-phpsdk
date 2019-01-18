<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\ScheduledPayments\BankAccount;

use EoneoPay\PhpSdk\Requests\ScheduledPayments\ScheduledPaymentRequest;
use EoneoPay\PhpSdk\Responses\ScheduledPayments\BankAccount;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CreateRequest extends ScheduledPaymentRequest
{
    /**
     * Bank account endpoint.
     *
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
        return BankAccount::class;
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
