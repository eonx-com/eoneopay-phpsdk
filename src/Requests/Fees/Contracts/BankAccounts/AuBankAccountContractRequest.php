<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Fees\Contracts\BankAccounts;

use EoneoPay\PhpSdk\Requests\Fees\ContractRequest;

class AuBankAccountContractRequest extends ContractRequest
{
    /**
     * Construct AU bank account fee contract request.
     *
     * @param mixed[]|null $data Request data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct(\array_merge($data ?? [], [
            'group' => self::GROUP_BANK_ACCOUNT
        ]));
    }
}
