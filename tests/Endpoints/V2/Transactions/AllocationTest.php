<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\V2\Transactions;

use EoneoPay\PhpSdk\Endpoints\V2\Transactions\Allocation;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\Transactions\Allocation
 */
class AllocationTest extends TestCase
{
    /**
     * Tests uris
     *
     * @return void
     */
    public function testUris(): void
    {
        $allocation = new Allocation();

        self::assertSame([], $allocation->uris());
    }
}
