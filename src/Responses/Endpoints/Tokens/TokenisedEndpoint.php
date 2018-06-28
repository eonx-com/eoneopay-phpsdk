<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Endpoints\Tokens;

use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getName()
 * @method null|string getToken()
 */
class TokenisedEndpoint extends BaseDataTransferObject
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