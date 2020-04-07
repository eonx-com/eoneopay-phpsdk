<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\V2\Transactions\Allocations;

use EoneoPay\PhpSdk\Endpoints\V2\Transactions\Allocations\Record;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\Transactions\Allocations\Record
 */
class RecordTest extends TestCase
{
    /**
     * Tests uris
     *
     * @return void
     */
    public function testUris(): void
    {
        $record = new Record();

        self::assertSame([], $record->uris());
    }
}
