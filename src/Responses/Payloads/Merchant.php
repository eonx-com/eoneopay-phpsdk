<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Payloads;

class Merchant
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $externalId;

    /**
     * @var string
     */
    private $id;

    /**
     * Get api_key.
     *
     * @return null|string
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * Get email.
     *
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Get external id.
     *
     * @return null|string
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * Get id.
     *
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set api_key.
     *
     * @param string $apiKey
     *
     * @return Merchant
     */
    public function setApiKey(string $apiKey): Merchant
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Merchant
     */
    public function setEmail(string $email): Merchant
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set external_id.
     *
     * @param string $externalId
     *
     * @return Merchant
     */
    public function setExternalId(string $externalId): Merchant
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * Set id.
     *
     * @param string $id
     *
     * @return Merchant
     */
    public function setId(string $id): Merchant
    {
        $this->id = $id;

        return $this;
    }
}
