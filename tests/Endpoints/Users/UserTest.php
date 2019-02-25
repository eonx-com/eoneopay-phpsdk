<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\Users\User;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Users\User
 */
class UserTest extends TestCase
{
    /**
     * Test Create User
     *
     * @return void
     */
    public function testCreateUser(): void
    {
        $userId = $this->generateId('ext_id_');
        $userEmail = $this->generateId('email') . '@email.com';

        $user = $this->createApiManager([
            'id' => $userId,
            'email' => $userEmail
        ], 200)
            ->getRepository(User::class)
            ->create((string)\getenv('PAYMENTS_API_KEY'), $userId, $userEmail);

        self::assertSame($userEmail, $user->getEmail());
    }
}
