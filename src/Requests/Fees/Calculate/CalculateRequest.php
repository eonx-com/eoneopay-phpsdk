<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Fees\Calculate;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Traits\Requests\Calculate\FeeTrait;

abstract class CalculateRequest extends AbstractRequest
{
    use FeeTrait;

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
