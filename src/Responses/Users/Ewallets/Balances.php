<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users\Ewallets;

use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method string|null getAvailable()
 * @method string|null getBalance()
 */
class Balances extends BaseDataTransferObject
{
    /**
     * Available balance.
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $available;

    /**
     * Balance.
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $balance;
}
