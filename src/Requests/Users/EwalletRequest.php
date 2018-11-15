<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Users\Ewallet;
use EoneoPay\PhpSdk\Traits\Requests\Payloads\EwalletTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestSerializationGroupAwareInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestValidationGroupAwareInterface;

class EwalletRequest extends AbstractRequest implements
    RequestSerializationGroupAwareInterface,
    RequestValidationGroupAwareInterface
{
    use EwalletTrait;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return Ewallet::class;
    }

    /**
     * @inheritdoc
     */
    public function serializationGroup(): array
    {
        return [self::CREATE => ['new']];
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/users/%s/ewallets', $this->id)
        ];
    }

    /**
     * @inheritdoc
     */
    public function validationGroups(): array
    {
        return [self::CREATE => ['new']];
    }
}
