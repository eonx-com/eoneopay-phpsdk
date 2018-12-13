<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses;

use EoneoPay\PhpSdk\Responses\Users\Ewallet;
use EoneoPay\PhpSdk\Traits\UserTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;

/**
 * @method null|string getEmail()
 * @method null|string getId()
 * @method null|string getPassword()
 * @method Ewallet getPrimaryEwallet()
 */
class User extends BaseDataTransferObject
{
    use UserTrait;

    /**
     * User's primary ewallet.
     *
     * @var \EoneoPay\PhpSdk\Responses\Users\Ewallet
     */
    protected $primaryEwallet;
}