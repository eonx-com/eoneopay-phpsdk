<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces\Endpoints;

interface VersionedEndpointInterface
{
    /**
     * Get endpoint api version to use.
     *
     * @return int
     */
    public function getVersion(): int;
}
