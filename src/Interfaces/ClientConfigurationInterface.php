<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces;

interface ClientConfigurationInterface
{
    /**
     * Get API key.
     *
     * @return string
     */
    public function getApiKey(): string;

    /**
     * Get base uri.
     *
     * @return string
     */
    public function getBaseUri(): string;
}
