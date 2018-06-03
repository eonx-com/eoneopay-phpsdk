<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Payloads;

class TokenisedCreditCard extends CreditCard
{
    /**
     * @var string
     */
    private $endpointId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $tokenId;

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
     * Get token id.
     *
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->tokenId;
    }

    /**
     * Get name.
     *
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set endpoint_id.
     *
     * @param string $endpointId
     *
     * @return \EoneoPay\PhpSdk\Responses\Payloads\TokenisedCreditCard
     */
    public function setEndpointId(string $endpointId): TokenisedCreditCard
    {
        $this->endpointId = $endpointId;

        return $this;
    }

    /**
     * Set token id.
     *
     * @param string $tokenId
     *
     * @return \EoneoPay\PhpSdk\Responses\Payloads\TokenisedCreditCard
     */
    public function setId(string $tokenId): TokenisedCreditCard
    {
        $this->tokenId = $tokenId;

        return $this;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return \EoneoPay\PhpSdk\Responses\Payloads\TokenisedCreditCard
     */
    public function setName(string $name): TokenisedCreditCard
    {
        $this->name = $name;

        return $this;
    }
}
