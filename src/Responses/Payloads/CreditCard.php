<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Payloads;

class CreditCard
{
    /**
     * @var string
     */
    private $expiresAt;

    /**
     * @var string
     */
    private $pan;

    /**
     * Get expires_at.
     *
     * @return null|string
     */
    public function getExpiresAt(): ?string
    {
        return $this->expiresAt;
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
     * Set expires_at.
     *
     * @param string $expiresAt
     *
     * @return CreditCard
     */
    public function setExpiresAt(string $expiresAt): CreditCard
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Set pan.
     *
     * @param string $pan
     *
     * @return CreditCard
     */
    public function setPan(string $pan): CreditCard
    {
        $this->pan = $pan;

        return $this;
    }
}
