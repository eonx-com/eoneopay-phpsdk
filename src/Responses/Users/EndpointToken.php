<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users;

use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method null|string getName()
 * @method null|string getToken()
 */
abstract class EndpointToken extends BaseDataTransferObject
{
    /**
     * @Groups({"tokenise"})
     *
     * @var null|string
     */
    protected $name;

    /**
     * @Groups({"tokenise"})
     *
     * @var null|string
     */
    protected $token;
}
