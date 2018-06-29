<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces;

interface TransactionResponseInterface
{
    /**
     * Get amount.
     *
     * @return null|string
     */
    public function getAmount(): ?string;

    /**
     * Get currency.
     *
     * @return null|string
     */
    public function getCurrency(): ?string;

    /**
     * Get id.
     *
     * @return null|string
     */
    public function getId(): ?string;

    /**
     * Get reference.
     *
     * @return null|string
     */
    public function getReference(): ?string;

    /**
     * Get request id.
     *
     * @return null|string
     */
    public function getRequestId(): ?string;

    /**
     * Get settled at.
     *
     * @return null|string
     */
    public function getSettledAt(): ?string;

    /**
     * Get response status.
     *
     * @return null|int
     */
    public function getStatus(): ?int;
}
