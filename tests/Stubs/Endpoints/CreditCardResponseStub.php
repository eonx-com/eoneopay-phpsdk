<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Endpoints;

use EoneoPay\Utils\Arr;

class CreditCardResponseStub
{
    /**
     * Response data.
     *
     * @var mixed[]
     */
    private $data;

    /**
     * Construct credit card stub
     *
     * @param mixed[]|null $data Credit card
     */
    public function __construct(?array $data = null)
    {
        $this->data = \array_merge([
            'country' => 'US',
            'expiry' => [
                'month' => '05',
                'year' => '2099'
            ],
            'id' => \uniqid('', false),
            'issuer' => 'U.S. BANK NATIONAL ASSOCIATION, ND',
            'method' => 'DEBIT',
            'pan' => '5123450...0008',
            'prepaid' => null,
            'scheme' => 'Mastercard'
        ], $data ?? []);
    }

    /**
     * Serialise to array.
     *
     * @return mixed[]
     */
    public function toArray(): array
    {
        return (new Arr())->sort($this->data);
    }
}
