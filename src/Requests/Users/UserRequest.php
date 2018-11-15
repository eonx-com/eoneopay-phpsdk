<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\User;
use EoneoPay\PhpSdk\Traits\UserTrait;

class UserRequest extends AbstractRequest
{
    use UserTrait;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return User::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/users/%s', $this->id)
        ];
    }
}
