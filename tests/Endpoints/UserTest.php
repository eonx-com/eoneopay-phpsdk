<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Users\User
 */
class UserTest extends TestCase
{
    /**
     * @var string
     */
    private $userEmail;

    /**
     * @var string
     */
    private $userId;

    /**
     * Check if creating existing user throws exception
     * Does not start with 'test' as needs to run after a valid user has been created
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
                    'The email has already been taken.'
                ],
                'external_id' => [
                    'The external_id has already been taken.'
                ]
            ]
        ], 400)
            ->create(
                'api-key',
                new User([
                    'id' => $this->userId,
                    'email' => $this->userEmail
                ])
            );
    }

    /**
     * Test Create User
     *
     * @return void
     */
    public function testCreateUser(): void
    {
        // Generate user details
        $this->generateUserDetails();

        $user = $this->createApiManager([
            'created_at' => '2019-02-26T00=>01=>39Z',
            'id' => $this->userId,
            'email' => $this->userEmail,
            'updated_at' => '2019-02-26T00=>01=>39Z'
        ], 201)
            ->create(
                'api-key',
                new User([
                    'id' => $this->userId,
                    'email' => $this->userEmail
                ])
            );

        self::assertSame($this->userEmail, $user->getEmail());

        // Exception thrown asserts
        $this->checkExceptionThrownOnExistingUserCreation();
    }

    /**
     * Generate User details to use in multiple test cases
     *
     * @return void
     */
    private function generateUserDetails(): void
    {
        if ($this->userId === null) {
            $this->userId = $this->generateId('ext_id_');
        }

        if ($this->userEmail === null) {
            $this->userEmail = $this->generateId('email') . '@email.com';
        }
    }
}
