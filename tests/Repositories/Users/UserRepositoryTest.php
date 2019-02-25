<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Repositories\Users;

use EoneoPay\PhpSdk\Endpoints\Users\User;
use EoneoPay\PhpSdk\Exceptions\ValidationException;
use EoneoPay\PhpSdk\Repositories\Users\UserRepository;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Repositories\Users\UserRepository
 */
class UserRepositoryTest extends TestCase
{
    /**
     * Test if appropriate exception is thrown if user already exists, or any other response error
     *
     * @return void
     */
    public function testExceptionIsThrownOnExistingUserCreation(): void
    {

        $userId = $this->generateId('ext_id_');
        $userEmail = $this->generateId('email') . '@email.com';

        $repository = $this->createApiManager([
            'code' => 6210 // expected exception code
        ], 400)->getRepository(User::class);

        // ensure repository is instance of as we want
        self::assertInstanceOf(UserRepository::class, $repository);

        $this->expectException(ValidationException::class);
        $repository->create((string)\getenv('PAYMENTS_API_KEY'), $userId, $userEmail);
        // recreate same user and check exception
        $repository->create((string)\getenv('PAYMENTS_API_KEY'), $userId, $userEmail);
    }

    /**
     * Test if valid user is returned
     *
     * @return void
     */
    public function testValidUserIsReturned(): void
    {
        $userId = $this->generateId('ext_id_');
        $userEmail = $this->generateId('email') . '@email.com';

        $repository = $this->createApiManager([
            'email' => $userEmail,
            'id' => $userId
        ])->getRepository(User::class);

        // ensure repository is instance of as we want
        self::assertInstanceOf(UserRepository::class, $repository);

        $paymentSource = $repository->create((string)\getenv('PAYMENTS_API_KEY'), $userId, $userEmail);

        self::assertNotNull($paymentSource);
        self::assertInstanceOf(User::class, $paymentSource);
        self::assertSame($userEmail, $paymentSource->getEmail());
        self::assertSame($userId, $paymentSource->getId());
    }
}
