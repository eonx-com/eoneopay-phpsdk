<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\User;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\User
 */
class UserTest extends TestCase
{
    /**
     * Test create user successfully
     *
     * @return void
     */
    public function testCreateSuccessfully(): void
    {
        $data = [
            'email' => 'user@email.test',
            'id' => $this->generateId()
        ];

        $actual = $this->createApiManager($data)->create('api-key', new User($data));

        self::assertSame(
            $data['email'],
            ($actual instanceof User) === true ? $actual->getEmail() : null
        );
        self::assertSame(
            $data['id'],
            ($actual instanceof User) === true ? $actual->getId() : null
        );
    }
}
