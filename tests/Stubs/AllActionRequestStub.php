<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\User;

class AllActionRequestStub extends AbstractRequest
{
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
            self::CREATE => 'test',
            self::DELETE => 'test',
            self::GET => 'test',
            self::LIST => 'test',
            self::UPDATE => 'test'
        ];
    }
}
