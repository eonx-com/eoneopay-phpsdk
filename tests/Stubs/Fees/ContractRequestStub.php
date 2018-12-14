<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Fees;

use EoneoPay\PhpSdk\Requests\Fees\ContractRequest;

class ContractRequestStub extends ContractRequest
{
    /**
     * ContractRequestStub constructor.
     *
     * @param mixed[]|null $data Request data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct(\array_merge($data ?? [], [
            'group' => 'Stub'
        ]));
    }
}
