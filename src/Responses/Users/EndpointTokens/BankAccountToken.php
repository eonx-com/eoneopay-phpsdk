<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users\EndpointTokens;

use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Responses\Users\EndpointToken;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method null|BankAccount getBankAccount()
 */
class BankAccountToken extends EndpointToken
{
    /**
     * Bank account endpoint.
     *
     * @Groups({"get", "tokenise"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\BankAccount
     */
    protected $bankAccount;
}
