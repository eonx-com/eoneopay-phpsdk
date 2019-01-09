<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Endpoints;

use EoneoPay\PhpSdk\Requests\Endpoints\TokenRequest;

class TokenRequestStub extends TokenRequest
{
    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return null;
    }
}
