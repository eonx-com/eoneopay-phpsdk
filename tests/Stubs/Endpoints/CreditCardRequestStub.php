<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Endpoints;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;

class CreditCardRequestStub extends CreditCard
{
    /**
     * Construct credit card stub
     *
     * @param mixed[]|null $data Credit card
     */
    public function __construct(?array $data = null)
    {
        parent::__construct(\array_merge([
            'cvc' => '100',
            'expiry' => new Expiry([
                'month' => '05',
                'year' => '2099'
            ]),
            'name' => 'John Wick',
            'number' => '5123450000000008'
        ], $data ?? []));
    }
}
