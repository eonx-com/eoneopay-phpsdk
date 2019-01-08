<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\SchedulePayments;

use EoneoPay\PhpSdk\Requests\Payloads\Allocation;

class AllocationStub extends Allocation
{
    /**
     * Construct allocation stub.
     *
     * @param mixed[]|null $data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct(\array_merge([
            'ewallet' => '9H9BXKEKD9',
            'percentage' => '50'
        ], $data ?? []));
    }
}
