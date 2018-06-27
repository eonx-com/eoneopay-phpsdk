<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests;

use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestMethodInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;

abstract class AbstractRequest extends BaseDataTransferObject implements RequestMethodInterface, RequestObjectInterface
{
    /**
     * {@inheritdoc}
     */
    abstract public function expectObject(): string;

    /**
     * {@inheritdoc}
     */
    abstract public function uris(): array;
}
