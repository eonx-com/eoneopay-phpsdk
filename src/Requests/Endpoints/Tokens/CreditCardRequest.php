<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Endpoints\Tokens;

use EoneoPay\PhpSdk\Requests\Endpoints\TokenRequest;
use EoneoPay\PhpSdk\Responses\Users\EndpointTokens\CreditCardToken;

class CreditCardRequest extends TokenRequest
{
    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return CreditCardToken::class;
    }
}
