<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Payloads;

class TokenisedBankAccount extends BankAccount
{
    /**
     * @var string
     */
    private $bsb;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $tokenId;

    /**
     * Get bsb.
     *
     * @return null|string
     */
    public function getBsb(): ?string
    {
        return $this->bsb;
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
     * Set bsb.
     *
     * @param string $bsb
     *
     * @return TokenisedBankAccount
     */
    public function setBsb(string $bsb): TokenisedBankAccount
    {
        $this->bsb = $bsb;

        return $this;
    }

    /**
     * Set token id.
     *
     * @param string $tokenId
     *
     * @return TokenisedBankAccount
     */
    public function setId(string $tokenId): TokenisedBankAccount
    {
        $this->tokenId = $tokenId;

        return $this;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return TokenisedBankAccount
     */
    public function setName(string $name): TokenisedBankAccount
    {
        $this->name = $name;

        return $this;
    }
}
