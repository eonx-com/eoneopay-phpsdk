<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Endpoints\V2\User;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\User
 */
class UserTest extends TestCase
{
    /**
     * Tests getters.
     *
     * @return void
     */
    public function testGetters(): void
    {
        $user = new User([
            'created_at' => '2019-02-26T00:01:39Z',
            'id' => 'user_id',
            'email' => 'user@example.com',
            'updated_at' => '2019-02-26T01:01:39Z',
        ]);

        self::assertSame('2019-02-26T00:01:39Z', $user->getCreatedAt());
        self::assertSame('user_id', $user->getId());
        self::assertSame('user@example.com', $user->getEmail());
        self::assertSame('2019-02-26T01:01:39Z', $user->getUpdatedAt());
    }

    /**
     * Tests uris
     *
     * @return void
     */
    public function testUris(): void
    {
        $user = new User();

        self::assertSame([], $user->uris());
    }
}
