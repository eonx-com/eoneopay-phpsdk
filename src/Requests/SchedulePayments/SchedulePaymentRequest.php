<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\SchedulePayments;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Traits\SchedulePaymentTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestSerializationGroupAwareInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestValidationGroupAwareInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

abstract class SchedulePaymentRequest extends AbstractRequest implements
    RequestSerializationGroupAwareInterface,
    RequestValidationGroupAwareInterface
{
    use SchedulePaymentTrait;

    /**
     * Schedule payment allocation.
     *
     * @Assert\Valid(groups={"create_schedule"})
     *
     * @Groups({"create_schedule"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Allocation
     */
    protected $allocation;

    /**
     * Schedule payment amount.
     *
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create", "get", "list"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Amount
     */
    protected $amount;

    /**
     * @inheritdoc
     */
    public function serializationGroup(): array
    {
        return [self::CREATE => ['create', 'create_schedule']];
    }

    /**
     * @inheritdoc
     */
    public function validationGroups(): array
    {
        return [self::CREATE => ['create', 'create_schedule']];
    }
}
