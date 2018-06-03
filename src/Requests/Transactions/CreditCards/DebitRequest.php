<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Abstracts\Requests\Transactions\AbstractCreditCardRequest;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;

class DebitRequest extends AbstractCreditCardRequest implements RequestObjectInterface
{
    /**
     * Don't prefix method with get or set as serializer will output the method name as attributes.
     *
     * Specify the request uri.
     *
     * @return array
     */
    public function uris(): array
    {
        return [
            self::CREATE => $this->url('debit')
        ];
    }
}
