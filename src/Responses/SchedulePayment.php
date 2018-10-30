<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Traits\SchedulePaymentTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method null|Amount getAmount()
 * @method null|string getEndDate()
 * @method null|string getFrequency()
 * @method null|string getId()
 * @method null|string getStartDate()
 */
class SchedulePayment extends BaseDataTransferObject
{
    use SchedulePaymentTrait;

    /**
     * Amount.
     *
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create", "update", "delete"})
     *
     * @Groups({"create", "update", "get", "list"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Amount
     */
    protected $amount;
}
