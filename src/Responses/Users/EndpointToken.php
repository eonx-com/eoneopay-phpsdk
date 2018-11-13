<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users;

use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getName()
 * @method null|string getToken()
 */
class EndpointToken extends BaseDataTransferObject
{
    /**
     * @var null|string
     */
    protected $name;

    /**
     * @var null|string
     */
    protected $token;
}
