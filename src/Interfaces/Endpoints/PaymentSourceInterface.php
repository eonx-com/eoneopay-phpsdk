<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces\Endpoints;

interface PaymentSourceInterface
{
    /**
     * Bank account payment source.
     *
     * @var string
     */
    public const SOURCE_BANK_ACCOUNT = 'bank_account';

    /**
     * Credit card payment source.
     *
     * @var string
     */
    public const SOURCE_CREDIT_CARD = 'credit_card';

    /**
     * Ewallet payment source.
     *
     * @var string
     */
    public const SOURCE_EWALLET = 'ewallet';
}