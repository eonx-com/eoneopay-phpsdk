<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Endpoints\V2\Balance;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\Balance
 */
class BalanceTest extends TestCase
{
    /**
     * Test creation of a balance entity.
     *
     * @return void
     */
    public function testBalanceCreation(): void
    {
        $balance = new Balance([
            'available' => '12.34',
            'balance' => '56.78',
            'credit_limit' => '90.12',
        ]);

        self::assertEquals('12.34', $balance->getAvailable());
        self::assertEquals('56.78', $balance->getBalance());
        self::assertEquals('90.12', $balance->getCreditLimit());
    }

    /**
     * Test that this entity has no accessible URIs.
     *
     * @return void
     */
    public function testUriList(): void
    {
        $entity = new Balance([]);

        $uris = $entity->uris();

        self::assertEmpty($uris);
    }
}
