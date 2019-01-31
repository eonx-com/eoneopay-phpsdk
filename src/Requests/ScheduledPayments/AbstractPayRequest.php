<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\ScheduledPayments;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractPayRequest extends AbstractRequest
{
    /**
     * Schedule payment amount.
     *
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Amount
     */
    protected $amount;

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
     * Statement Description.
     *
     * @Groups({"create"})
     *
     * @var null|string
     */
    protected $statementDescription;

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
