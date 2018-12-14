<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Endpoints;

use EoneoPay\Utils\Arr;

class EwalletResponseStub
{
    /**
     * Response data.
     *
     * @var mixed[]
     */
    private $data;

    /**
     * EwalletStub constructor.
     *
     * @param mixed[]|null $data
     */
    public function __construct(?array $data = null)
    {
        $this->data = \array_merge([
            'currency' => 'AUD',
            'id' => \uniqid('', false),
            'pan' => '2...H6A3',
            'reference' => '2JERVUH6A3'
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
