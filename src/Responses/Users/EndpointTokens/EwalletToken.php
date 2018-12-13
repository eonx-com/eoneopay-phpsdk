<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users\EndpointTokens;

use EoneoPay\PhpSdk\Requests\Payloads\Ewallet;
use EoneoPay\PhpSdk\Responses\Users\EndpointToken;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method null|Ewallet getEwallet()
 */
class EwalletToken extends EndpointToken
{
    /**
     * Ewallet endpoint.
     *
     * @Groups({"tokenise"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Ewallet
     */
    protected $ewallet;
}
