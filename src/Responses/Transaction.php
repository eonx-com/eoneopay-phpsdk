<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Responses\Transactions\Response;
use EoneoPay\PhpSdk\Traits\TransactionTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method null|Amount getAmount()
 * @method null|bool getApproved()
 * @method null|string getCompletedAt()
 * @method null|string getId()
 * @method null|Response getResponse()
 * @method null|string getStatus()
 */
abstract class Transaction extends BaseDataTransferObject
{
    use TransactionTrait;

    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create", "update", "delete"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Amount
     */
    protected $amount;

    /**
     * @Groups({"create", "update"})
     *
     * @var null|\EoneoPay\PhpSdk\Responses\Transactions\Response
     */
    protected $response;
}
