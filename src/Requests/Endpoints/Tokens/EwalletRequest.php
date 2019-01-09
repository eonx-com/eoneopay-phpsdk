<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Endpoints\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\TokenRequest;
use EoneoPay\PhpSdk\Responses\Users\EndpointTokens\EwalletToken;

class EwalletRequest extends TokenRequest
{
    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return EwalletToken::class;
    }
}
