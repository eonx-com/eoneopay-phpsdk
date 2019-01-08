<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\SchedulePayments;

use EoneoPay\PhpSdk\Requests\Payloads\Allocation;

class AllocationStub extends Allocation
{
    public function __construct(?array $data = null)
    {
        parent::__construct(\array_merge([
            'ewallet' => 'test-ewallet',
            'percentage' => '50'
        ], $data ?? []));
    }
}
