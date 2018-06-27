<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Merchants;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Merchant;
use EoneoPay\PhpSdk\Traits\MerchantTrait;

class MerchantRequest extends AbstractRequest
{
    use MerchantTrait;

    /**
     * {@inheritdoc}
     */
    public function expectObject(): string
    {
        return Merchant::class;
    }

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/merchants',
            self::UPDATE => \sprintf('merchants/%s', $this->id),
            self::DELETE => \sprintf('merchants/%s', $this->id)
        ];
    }
}
