<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Requests\Users\UserRequest;
use EoneoPay\PhpSdk\Responses\User;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Users\UserRequest
 */
class UserRequestTest extends RequestTestCase
{
    /**
     * Test create user successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testCreateSuccessfully(): void
    {
        $data = [
            'id' => \uniqid('test-', false),
            'email' => 'genuine.user@email.test'
        ];

        /** @var \EoneoPay\PhpSdk\Responses\User $user */
        $user = $this->createClient($data)->create(new UserRequest($data));

        self::assertInstanceOf(User::class, $user);
        self::assertSame($data['id'], $user->getId());
        self::assertSame($data['email'], $user->getEmail());
    }

    /**
     * Test create fails with exception when invalid data is provided.
     *
     * @return void
     */
    public function testCreateFailsWithException(): void
    {
        $data = [];

        try {
            $this->createClient($data)->create(new UserRequest($data));
        } catch (\Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'id' => ['This value should not be blank.'],
                    'email' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }
}
