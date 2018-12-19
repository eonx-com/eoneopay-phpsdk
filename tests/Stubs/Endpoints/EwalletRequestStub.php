<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Endpoints;

use EoneoPay\PhpSdk\Requests\Payloads\Ewallet;

class EwalletRequestStub extends Ewallet
{
    /**
     * EwalletStub constructor.
     *
     * @param mixed[]|null $data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct(\array_merge([
            'name' => 'John Wick',
            'reference' => '2JERVUH6A3'
        ], $data ?? []));
    }
}
