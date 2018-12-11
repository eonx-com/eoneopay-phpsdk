<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Fees\Contracts\CreditCards;

use EoneoPay\PhpSdk\Requests\Fees\ContractRequest;

class DiscoverContractRequest extends ContractRequest
{
    /**
     * Construct discover fee contract request.
     *
     * @param mixed[]|null $data Request data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct(\array_merge($data ?? [], [
            'group' => self::GROUP_CREDIT_CARD_DISCOVER
        ]));
    }
}
