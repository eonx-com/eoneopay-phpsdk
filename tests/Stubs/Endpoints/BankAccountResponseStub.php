<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Endpoints;

use EoneoPay\Utils\Arr;

class BankAccountResponseStub
{
    /**
     * Response data.
     *
     * @var mixed[]
     */
    private $data;

    /**
     * Bank account response stub.
     *
     * @param mixed[]|null $data
     */
    public function __construct(?array $data = null)
    {
        $this->data = \array_merge([
            'currency' => 'AUD',
            'id' => \uniqid('', true),
            'pan' => '123-123...6601',
            'prefix' => '123123',
            'number' => '0876601'
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
