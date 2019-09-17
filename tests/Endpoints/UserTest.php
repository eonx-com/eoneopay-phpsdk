<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\User
 */
final class UserTest extends TestCase
{
    /**
     * @var \EoneoPay\PhpSdk\Endpoints\User
     */
    private $user;

    /**
     * Check if creating existing user throws exception
     * Does not start with 'test' as needs to run after a valid user has been created
     * in testCreateUser.
     *
     * @return void
     */
    public function checkExceptionThrownOnExistingUserCreation(): void
    {
        $this->expectException(ValidationException::class);
        $this->createApiManager([
            'code' => 6210,
            'message' => 'User (external-user-idsad) already exists with email examplesasaeww@user.test.',
            'sub_code' => 1,
            'time' => '2019-02-26T00=>04=>13Z',
            'violations' => [
                'email' => [
                    'The email has already been taken.',
                ],
                'external_id' => [
                    'The external_id has already been taken.',
                ],
            ],
        ], 400)
            ->create(
                (string)\getenv('PAYMENTS_API_KEY'),
                $this->getUser()
            );
    }

    /**
     * Test Create User.
     *
     * @return void
     */
    public function testCreateUser(): void
    {
        $user = $this->createApiManager([
            'created_at' => '2019-02-26T00=>01=>39Z',
            'id' => $this->getUser()->getId(),
            'email' => $this->getUser()->getEmail(),
            'updated_at' => '2019-02-26T00=>01=>39Z',
        ], 201)
            ->create(
                (string)\getenv('PAYMENTS_API_KEY'),
                $this->getUser()
            );

        self::assertSame($this->getUser()->getEmail(), ($user instanceof User) ? $user->getEmail() : null);

        // Exception thrown assertion
        $this->checkExceptionThrownOnExistingUserCreation();
    }

    /**
     * Test get profile returns a User.
     *
     * @return void
     */
    public function testGetProfile(): void
    {
        $user = $this->createApiManager([
            'created_at' => '2019-02-22T03=>09=>44Z',
            'email' => 'example@user.test',
            'updated_at' => '2019-02-22T03=>09=>44Z',
        ], 201)
            ->findOneBy(
                User::class,
                (string)\getenv('PAYMENTS_API_KEY'),
                []
            );

        self::assertInstanceOf(User::class, $user);
        self::assertIsString(($user instanceof User) ? $user->getEmail() : null);
    }

    /**
     * Helper function to generate user.
     *
     * @return \EoneoPay\PhpSdk\Endpoints\User
     */
    private function getUser(): User
    {
        if ($this->user === null) {
            $userId = $this->generateId('ext_id_');
            $userEmail = $this->generateId('email') . '@email.com';

            $this->user = new User([
                'id' => $userId,
                'email' => $userEmail,
            ]);
        }

        return $this->user;
    }
}
