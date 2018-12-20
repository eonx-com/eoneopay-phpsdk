<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces;

use GuzzleHttp\Handler\MockHandler;

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

    /**
     * Get handler
     *
     * @return \GuzzleHttp\Handler\MockHandler|null
     */
    public function getHandler(): ?MockHandler;
}
