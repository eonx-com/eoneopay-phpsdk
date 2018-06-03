<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Abstracts\Requests;

abstract class AbstractTokenRequest extends AbstractTransactionRequest
{
    /**
     * Don't prefix method with get or set as serializer will output the method name as attributes.
     *
     * Specify the request uri.
     *
     * @return string[]
     */
    public function uris(): array
    {
        return [
            self::CREATE => $this->url('tokenise')
        ];
    }
}
