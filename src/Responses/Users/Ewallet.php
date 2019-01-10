<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Users;

use EoneoPay\PhpSdk\Responses\Users\Ewallets\Balances;
use EoneoPay\PhpSdk\Traits\Requests\Payloads\EwalletTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method null|Balances getBalances()
 * @method null|string getCurrency()
 * @method null|string getId()
 * @method null|string getPan()
 * @method null|string getReference()
 */
class Ewallet extends BaseDataTransferObject
{
    use EwalletTrait;

    /**
     * Ewallet balance.
     *
     * @Groups({"get"})
     *
     * @var null|\EoneoPay\PhpSdk\Responses\Users\Ewallets\Balances
     */
    protected $balances;
}
