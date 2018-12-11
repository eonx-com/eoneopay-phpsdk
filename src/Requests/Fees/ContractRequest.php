<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Fees;

use EoneoPay\PhpSdk\Interfaces\Requests\Fees\ContractRequestInterface;
use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Fee;
use EoneoPay\PhpSdk\Traits\FeeTrait;

abstract class ContractRequest extends AbstractRequest implements ContractRequestInterface
{
    use FeeTrait;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return Fee::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/fees/contracts',
            self::UPDATE => '/fees/contracts'
        ];
    }
}
