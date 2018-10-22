<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests;

use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestMethodAwareInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;

abstract class AbstractRequest extends BaseDataTransferObject implements
    RequestMethodAwareInterface,
    RequestObjectInterface
{
    /**
     * @inheritdoc
     */
    abstract public function expectObject(): ?string;

    /**
     * @inheritdoc
     */
    abstract public function uris(): array;
}
