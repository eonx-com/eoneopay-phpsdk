<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Transactions\Allocation;

use EoneoPay\PhpSdk\Endpoints\Ewallet;
use EoneoPay\PhpSdk\Endpoints\Transactions\Allocation;
use EoneoPay\PhpSdk\Endpoints\Transactions\Allocations\Record;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Transactions\Allocation
 */
final class AllocationTest extends TestCase
{
    /**
     * Test creation of an Allocation entity.
     *
     * @return void
     */
    public function testAllocationCreate(): void
    {
        $records = [new Record(), new Record()];
        $ewallet = new Ewallet([]);
        $amount = '50.00';

        $allocation = new Allocation([
            'amount' => $amount,
            'ewallet' => $ewallet,
            'records' => $records,
        ]);

        self::assertSame($amount, $allocation->getAmount());
        self::assertSame($ewallet, $allocation->getEwallet());
        self::assertSame($records, $allocation->getRecords());
    }

    /**
     * Test that this entity has no accessible URIs.
     *
     * @return void
     */
    public function testUriList(): void
    {
        $entity = new Allocation([]);

        $uris = $entity->uris();

        self::assertEmpty($uris);
    }
}
