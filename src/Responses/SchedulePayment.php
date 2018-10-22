<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses;

use EoneoPay\PhpSdk\Traits\SchedulePaymentTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getAmount()
 * @method null|string getCurrency()
 * @method null|string getEndDate()
 * @method null|string getFrequency()
 * @method null|string getId()
 * @method null|string getStartDate()
 */
class SchedulePayment extends BaseDataTransferObject
{
    use SchedulePaymentTrait;
}
