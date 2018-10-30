<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class PrimaryRequest extends BankAccountTransactionRequest
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
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => 'transactions/'
        ];
    }
}
