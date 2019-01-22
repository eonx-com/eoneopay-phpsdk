<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users;

use EoneoPay\PhpSdk\Responses\AbstractResponse;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method null|string getName()
 * @method null|string getToken()
 */
abstract class EndpointToken extends AbstractResponse
{
    /**
     * @Groups({"tokenise", "token_info"})
     *
     * @var null|string
     */
    protected $name;

    /**
     * @Groups({"tokenise", "token_info"})
     *
     * @var null|string
     */
    protected $token;
}
