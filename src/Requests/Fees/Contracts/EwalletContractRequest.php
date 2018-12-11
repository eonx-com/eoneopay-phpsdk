<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Fees\Contracts;

use EoneoPay\PhpSdk\Requests\Fees\ContractRequest;

class EwalletContractRequest extends ContractRequest
{
    /**
     * Construct visa fee contract request.
     *
     * @param mixed[]|null $data Request data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct(\array_merge($data ?? [], [
            'group' => self::GROUP_EWALLET
        ]));
    }
}
