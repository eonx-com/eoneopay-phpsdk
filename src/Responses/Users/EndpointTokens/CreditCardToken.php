<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users\EndpointTokens;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Responses\Users\EndpointToken;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method null|CreditCard getCreditCard()
 */
class CreditCardToken extends EndpointToken
{
    /**
     * Credit card endpoint.
     *
     * @Groups({"get", "tokenise"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCard
     */
    protected $creditCard;
}
