<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Endpoints\V2\Ewallet;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\Ewallet
 */
class EwalletTest extends TransactionTestCase
{
    /**
     * Tests V2 ewallet uri's.
     *
     * @return void
     */
    public function testUris(): void
    {
        $ewallet = new Ewallet();

        $uris = $ewallet->uris();

        self::assertSame([], $uris);
    }
}
