<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\BankAccounts;

use EoneoPay\PhpSdk\Abstracts\Requests\Transactions\AbstractBankAccountRequest;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;

class DebitRequest extends AbstractBankAccountRequest implements RequestObjectInterface
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
            self::CREATE => $this->url('debit')
        ];
    }
}
