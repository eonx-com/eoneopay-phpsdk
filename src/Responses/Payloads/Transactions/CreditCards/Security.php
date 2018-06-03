<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Payloads\Transactions\CreditCards;

/**
 * @SuppressWarnings(PHPMD.ShortVariable) id a required name of the payload.
 */
class Security
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $result;

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
     * Get result.
     *
     * @return bool
     */
    public function isResult(): bool
    {
        return $this->result ?? false;
    }

    /**
     * Set id.
     *
     * @param string $id
     *
     * @return Security
     */
    public function setId(string $id): Security
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set result.
     *
     * @param bool $result
     *
     * @return Security
     */
    public function setResult(bool $result): Security
    {
        $this->result = $result;

        return $this;
    }
}
