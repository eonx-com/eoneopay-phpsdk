<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\ScheduledPayments;

use EoneoPay\PhpSdk\Requests\Payloads\Ewallet as EwalletPayload;
use EoneoPay\PhpSdk\Responses\ScheduledPayment;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method null|EwalletPayload getEwallet()
 */
class Ewallet extends ScheduledPayment
{
    /**
     * Ewallet endpoint.
     *
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create", "get", "list"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Ewallet|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $ewallet;
}
