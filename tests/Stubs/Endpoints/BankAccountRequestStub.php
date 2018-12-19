<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Endpoints;

use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;

class BankAccountRequestStub extends BankAccount
{
    /**
     * Construct bank account stub
     *
     * @param mixed[]|null $data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct(\array_merge([
            'country' => 'AU',
            'prefix' => '123123',
            'name' => 'John Wick',
            'number' => '0876601'
        ], $data ?? []));
    }
}
