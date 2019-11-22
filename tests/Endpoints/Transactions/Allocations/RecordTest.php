<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Transactions\Allocations;

use EoneoPay\PhpSdk\Endpoints\Ewallet;
use EoneoPay\PhpSdk\Endpoints\Transactions\Allocations\Record;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Transactions\Allocations\Record
 */
final class RecordTest extends TestCase
{
    /**
     * Test creation of an Allocation entity.
     *
     * @return void
     */
    public function testAllocationCreate(): void
    {
        $ewallet = new Ewallet();

        $record = new Record([
            'amount' => '123.00',
            'ewallet' => $ewallet,
        ]);

        self::assertSame('123.00', $record->getAmount());
        self::assertSame($ewallet, $record->getEwallet());
    }

    /**
     * Test that this entity has no accessible URIs.
     *
     * @return void
     */
    public function testUriList(): void
    {
        $entity = new Record([]);

        $uris = $entity->uris();

        self::assertEmpty($uris);
    }
}
