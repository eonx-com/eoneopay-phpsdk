<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\Ewallets;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class PrimaryRequest extends EwalletTransactionRequest
{
    /**
     * Allocation.
     *
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\Allocation|null
     */
    protected $allocations;

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
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/transactions/%s', $this->id)
        ];
    }
}
