<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Abstracts\Requests\Endpoints;

use EoneoPay\PhpSdk\Abstracts\AbstractDataTransferObject;
use EoneoPay\PhpSdk\Traits\DefinesUris;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestMethodInterface;

abstract class AbstractCreateEndpointRequest extends AbstractDataTransferObject implements RequestMethodInterface
{
    use DefinesUris;

    /**
     * Don't prefix method with get or set as serializer will output the method name as attributes.
     *
     * Add options along with sending the request. For example, adding api key in the header.
     *
     * @return mixed[]
     */
    public function options(): array
    {
        return [];
    }

    /**
     * Don't prefix method with get or set as serializer will output the method name as attributes.
     *
     * Specify the request uri.
     *
     * @return string[]
     */
    public function uris(): array
    {
        return [
            self::CREATE => $this->url('endpoints')
        ];
    }
}
