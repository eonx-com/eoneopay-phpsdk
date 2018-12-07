<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Fees;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Traits\FeeTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @method null|Amount getAmount()
 */
abstract class FeeRequest extends AbstractRequest
{
    use FeeTrait;

    /**
     * @Assert\NotNull(groups={"create", "update", "delete"})
     * @Assert\Valid(groups={"create", "update", "delete"})
     *
     * @Groups({"create", "update", "delete"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Amount
     */
    protected $amount;

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/calculate/fees'
        ];
    }
}
