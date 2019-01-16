<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\Ewallets;

use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestSerializationGroupAwareInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestValidationGroupAwareInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class PrimaryRequest extends EwalletTransactionRequest implements
    RequestSerializationGroupAwareInterface,
    RequestValidationGroupAwareInterface
{
    /**
     * Allocation.
     *
     * @Assert\Valid(groups={"create_txn"})
     *
     * @Groups({"create_txn"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\Allocation|null
     */
    protected $allocation;

    /**
     * Destination ewallet token.
     *
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\Token|null
     */
    protected $destination;

    /**
     * @inheritdoc
     */
    public function serializationGroup(): array
    {
        return [self::CREATE => ['create', 'create_txn']];
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/orders/%s/transactions/%s', $this->id, $this->secondaryId)
        ];
    }

    /**
     * @inheritdoc
     */
    public function validationGroups(): array
    {
        return [self::CREATE => ['create', 'create_txn']];
    }
}
