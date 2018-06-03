<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use EoneoPay\PhpSdk\Interfaces\ConstantsInterface;

trait DefinesUris
{
    /**
     * Get url for given endpoint.
     *
     * @param string $endpoint
     *
     * @return string
     */
    protected function url(string $endpoint): string
    {
        return \sprintf('%s/%s', ConstantsInterface::BASE_URL, $endpoint);
    }
}
