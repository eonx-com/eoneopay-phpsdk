<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Payloads;

class Gateway
{
    /**
     * @var string
     */
    private $service;

    /**
     * Get service.
     *
     * @return null|string
     */
    public function getService(): ?string
    {
        return $this->service;
    }

    /**
     * Set service.
     *
     * @param string $service
     *
     * @return Gateway
     */
    public function setService(string $service): Gateway
    {
        $this->service = $service;

        return $this;
    }
}
