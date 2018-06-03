<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Payloads;

class BankAccount
{
    /**
     * @var string
     */
    private $endpointId;

    /**
     * @var string
     */
    private $pan;

    /**
     * Get endpoint_id.
     *
     * @return null|string
     */
    public function getEndpointId(): ?string
    {
        return $this->endpointId;
    }

    /**
     * Get pan.
     *
     * @return null|string
     */
    public function getPan(): ?string
    {
        return $this->pan;
    }

    /**
     * Set endpoint_id.
     *
     * @param string $endpointId
     *
     * @return BankAccount
     */
    public function setEndpointId(string $endpointId): BankAccount
    {
        $this->endpointId = $endpointId;

        return $this;
    }

    /**
     * Set pan.
     *
     * @param string $pan
     *
     * @return BankAccount
     */
    public function setPan(string $pan): BankAccount
    {
        $this->pan = $pan;

        return $this;
    }
}
